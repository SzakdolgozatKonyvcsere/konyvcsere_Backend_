<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatsController extends Controller
{
    /**
     * Új regisztrációk száma időbeli bontásban.
     * GET /api/admin/stats/registrations?interval=daily|weekly|monthly|yearly
     */
    public function newRegistrationsStat(Request $request)
    {
        
        $interval = $request->query('interval', 'daily');
        $fmt = $this->getDateFormat($interval);

        $data = DB::table('users')
            ->selectRaw("DATE_FORMAT(created_at, ?) as period, COUNT(*) as count", [$fmt])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($data);
    }

    /**
     * Bejelentkezések gyakorisága.
     * GET /api/admin/stats/logins?interval=daily|weekly|monthly|yearly
     */
    public function loginsStat(Request $request)
    {
        /*$interval = $request->query('interval', 'daily');
        $dateFormat = $this->getDateFormat($interval);

        $data = DB::table('login_histories')
            ->selectRaw("DATE_FORMAT(created_at, ?) as period, COUNT(*) as count", [$dateFormat])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($data);*/
        $interval = $request->query('interval', 'daily');
        $fmt = $this->getDateFormat($interval);

        $data = DB::table('sessions')
            ->selectRaw("DATE_FORMAT(FROM_UNIXTIME(last_activity), ?) as period, COUNT(*) as count", [$fmt])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($data);
    }

    /**
     * Összes feltöltött könyv kategóriánként.
     * GET /api/admin/stats/uploads-by-category
     */
    public function uploadsByCategoryStat()
    {
        $data = DB::table('book_offers as bo')
            ->join('works as w', 'bo.work', '=', 'w.work_id')
            ->join('genres as g', 'w.genre_id', '=', 'g.genre_id')
            ->select('g.genre_name as category', DB::raw('COUNT(*) as count'))
            ->groupBy('g.genre_name')
            ->orderByDesc('count')
            ->get();

        return response()->json($data);
    }

    /**
     * Új könyvfeltöltések időbeli trendje.
     * GET /api/admin/stats/uploads-trend?interval=daily|weekly|monthly|yearly
     */
    public function uploadsTrendStat(Request $request)
    {
        $interval = $request->query('interval', 'daily');
        $fmt = $this->getDateFormat($interval);

        $data = DB::table('book_offers')
            ->selectRaw("DATE_FORMAT(created_at, ?) as period, COUNT(*) as count", [$fmt])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($data);
    }

    /**
     * Lezárt cserék száma időbeli bontásban.
     * GET /api/admin/stats/exchanges-closed?interval=daily|weekly|monthly|yearly
     */
    public function closedExchangesStat(Request $request)
    {
        $interval = $request->query('interval', 'daily');
        $fmt = $this->getDateFormat($interval);

        $data = DB::table('exchange_histories')
            ->where('exchange_status', 'a')   // A = átadva
            ->selectRaw("DATE_FORMAT(updated_at, ?) as period, COUNT(*) as count", [$fmt])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($data);
    }

    /**
     * Sikeres vs. sikertelen cserék aránya.
     * GET /api/admin/stats/exchange-success-ratio
     */
    public function exchangeSuccessRatioStat()
    {
        $total   = DB::table('exchange_histories')->count();
        $success = DB::table('exchange_histories')->where('exchange_status', 'a')->count();
        $failed  = $total - $success;

        return response()->json([
            ['label' => 'Sikeres',   'value' => $success],
            ['label' => 'Sikertelen','value' => $failed ],
        ]);
    }

    /**
     * Átlagos csereidő (órában).
     * GET /api/admin/stats/avg-exchange-time
     */
    public function avgExchangeTimeStat()
    {
        // TIMESTAMPDIFF in hours
        $avg = DB::table('exchange_histories')
            ->where('exchange_status', 'A')
            ->selectRaw("AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_hours")
            ->value('avg_hours');

        return response()->json(['avg_hours' => round($avg, 2)]);
    }

    /**
     * Legnépszerűbb könyvek a kérések alapján.
     * GET /api/admin/stats/top-books
     */
    public function topBooksStat()
    {
        $data = DB::table('book_demands as bd')
            ->join('works as w', 'bd.work', '=', 'w.work_id')
            ->select('w.title', DB::raw('COUNT(*) as requests_count'))
            ->groupBy('w.title')
            ->orderByDesc('requests_count')
            ->limit(10)
            ->get();

        return response()->json($data);
    }

    /**
     * Legkeresettebb szerzők és műfajok.
     * GET /api/admin/stats/top-authors-genres
     */
    public function topAuthorsGenresStat()
    {
        $topAuthors = DB::table('book_demands as bd')
        ->join('written_bies as wb','bd.work','wb.work')
        ->join('authors as a',    'wb.author','a.author_id')
        ->select('a.author_name as name', DB::raw('COUNT(*) as requests_count'))
        ->groupBy('a.author_name')
        ->orderByDesc('requests_count')
        ->limit(10)
        ->get();

    $topGenres = DB::table('book_demands as bd')
        ->join('works as w',   'bd.work','w.work_id')
        ->join('genres as g',  'w.genre_id','g.genre_id')
        ->select('g.genre_name as name', DB::raw('COUNT(*) as requests_count'))
        ->groupBy('g.genre_name')
        ->orderByDesc('requests_count')
        ->limit(10)
        ->get();

    return response()->json([
        'authors' => $topAuthors,
        'genres'  => $topGenres,
    ]);
    }

    /**
     * Segédfüggvény: SQL DATE_FORMAT string kiválasztása interval alapján.
     */
    private function getDateFormat(string $interval): string
    {
        switch ($interval) {
            case 'weekly':  return '%x-%v';
            case 'monthly': return '%Y-%m';
            case 'yearly':  return '%Y';
            case 'daily':
            default:        return '%Y-%m-%d';
        }
    }
}
