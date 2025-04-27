<?php

namespace App\Observers;

use App\Models\Author;
use App\Models\BookDemand;
use App\Models\BookOffer;
use App\Models\Work;
use Illuminate\Support\Facades\Notification;


class BookOfferObserver
{
    /**
     * Handle the BookOffer "created" event.
     */


    public function created(BookOffer $offer): void
    {
        // a publ. ID már int
        $pubId   = $offer->publisher;
        $workId  = $offer->work;
        $language= $offer->language;
        $year    = $offer->publication_year;

        // work-relációból
        $genreId   = $offer->workModel->genre_id ?? null;
        $authorIds = $offer->workModel
                          ->authors
                          ->pluck('author_id')
                          ->all();

        $demands = BookDemand::query()
            // publisher FK
            ->when($pubId, fn($q)=> $q->where('publisher', $pubId))

            // work FK
            ->when($workId, fn($q)=> $q->where('work', $workId))

            // language
            ->when($language, fn($q)=> $q->where('language', $language))

            // év tartomány
            ->when($year, fn($q)=> $q->where('min_publication_year', '<=', $year)
                                      ->where('max_publication_year', '>=', $year))

            // genre a works táblán keresztül
            ->when($genreId, fn($q)=>
                $q->whereHas('workModel', fn($w)=>
                    $w->where('genre_id', $genreId)
                )
            )

            // author a pivot-on keresztül
            ->when(count($authorIds), fn($q)=>
                $q->whereHas('workModel.authors', fn($a)=>
                    $a->whereIn('author_id', $authorIds)
                )
            )

            ->get();

        foreach ($demands as $demand) {
            $demand->demand_status = 't';
            $demand->save();
        }





        /*$publisherName = optional($offer->publisherModel)->publisher_name;
         // 1) Kiinduló adatok
        //$publisherName = $offer->publisher->publisher_name;
        //$work          = $offer->work;
        //$title         = $work->title;
        $work = Work::find($offer->work);
        $title = $work->title;
        $genreId       = $work->genre_id;
        $authorIds     = $work->authors->pluck('author_id')->all();
        $language      = $offer->language;
        $year          = $offer->publication_year;

        // 2) Matching lekérdezés
        $demands = BookDemand::query()
            ->when($publisherName, function($q) use ($publisherName) {
                $q->where('publisher', $publisherName);
            })
            ->when($title, function($q) use ($title) {
                $q->where('title', $title);
            })
            ->when($genreId, function($q) use ($genreId) {
                $q->where('genre_id', $genreId);
            })
            ->when(! empty($authorIds), function($q) use ($authorIds) {
                // feltételezve, hogy a demands.author a név
                $names = Author::whereIn('author_id', $authorIds)
                               ->pluck('author_name')
                               ->all();
                $q->whereIn('author', $names);
            })
            ->when($language, function($q) use ($language) {
                $q->where('language', $language);
            })
            ->when($year, function($q) use ($year) {
                $q->where('min_publication_year', '<=', $year)
                  ->where('max_publication_year', '>=', $year);
            })
            ->get();

        // 3) Státuszfrissítés
        foreach ($demands as $demand) {
            $demand->demand_status = 'matched';
            $demand->save();
        } ---- */
        
        /*
        // Keresések lekérdezése, melyekre a most feltöltött kínálat illeszkedik
        $demands = BookDemand::query()
        // KIADÓ: ha a keresésben kiadó van megadva
        ->when($offer->publisher, fn($q) =>
            $q->where('publisher_name', $offer->publisher)
        )

        // MŰFAJ: a mű táblában szereplő mufaj_id egyezzen
        ->when($offer->work->genre_id, fn($q) =>
            $q->whereHas('work.genre', fn($g) =>
                $g->where('genre_id', $offer->work->genre)
            )
        )

        // CÍM: ha a keresésben a cím szerepel
        ->when($offer->work->title, fn($q) =>
            $q->whereHas('work', fn($w) =>
                $w->where('title', $offer->work->title)
            )
        )

        // SZERZŐ: ha több szerző is van, mind egyiknek egyezni kell
        ->when($offer->work->authors->isNotEmpty(), fn($q) =>
            $q->whereHas('work.authors', fn($a) =>
                $a->whereIn('author_id',
                    $offer->work->authors->pluck('author_id')->all()
                )
            )
        )

        // NYELV
        ->when($offer->language, fn($q) =>
            $q->where('language', $offer->language)
        )

        // KIADÁSI ÉV a keres tartományán belül
        ->when($offer->publication_year, fn($q) =>
            $q->where('min_publication_year', '<=', $offer->publication_year)
              ->where('max_publication_year', '>=', $offer->publication_year)
        )
        ->get();

    foreach ($demands as $demand) {
        $demand->demand_status = 't';
        $demand->save();
        /*Notification::send(
            $demand->user,
            new BookMatched($offer, $demand)
        );
    }*/

    }

    /**
     * Handle the BookOffer "updated" event.
     */
    public function updated(BookOffer $bookOffer): void
    {
        //
    }

    /**
     * Handle the BookOffer "deleted" event.
     */
    public function deleted(BookOffer $bookOffer): void
    {
        //
    }

    /**
     * Handle the BookOffer "restored" event.
     */
    public function restored(BookOffer $bookOffer): void
    {
        //
    }

    /**
     * Handle the BookOffer "force deleted" event.
     */
    public function forceDeleted(BookOffer $bookOffer): void
    {
        //
    }
}
