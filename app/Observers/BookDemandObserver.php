<?php

namespace App\Observers;

use App\Models\BookDemand;
use App\Models\BookOffer;
use Illuminate\Support\Facades\Notification;

class BookDemandObserver
{
    /**
     * Handle the BookDemand "created" event.
     */
    public function created(BookDemand $demand): void
    {

        $pubName = $demand->publisher;      // string/publisher ID
        $workId  = $demand->work;           // FK
        $lang    = $demand->language;
        $minYear = $demand->min_publication_year;
        $maxYear = $demand->max_publication_year;

        // A related Work modellből kinyerhető attribútumok:
        $genreId   = optional($demand->workModel)->genre_id;
        $author    = $demand->author;       // string, pivot nélkül

        $offers = BookOffer::query()
            // publisher FK szűrés
            ->when($pubName, fn($q)=> $q->where('publisher', $pubName))

            // work FK
            ->when($workId, fn($q)=> $q->where('work', $workId))

            // language
            ->when($lang, fn($q)=> $q->where('language', $lang))

            // publication_year intervallum
            ->when($minYear, fn($q)=> $q->where('publication_year','>=',$minYear))
            ->when($maxYear, fn($q)=> $q->where('publication_year','<=',$maxYear))

            // genre a Work reláción keresztül
            ->when($genreId, fn($q)=>
                $q->whereHas('workModel', fn($w)=>
                    $w->where('genre_id',$genreId)
                )
            )

            // author név a pivot Work→Author reláción keresztül
            ->when($author, fn($q)=>
                $q->whereHas('workModel.authors', fn($a)=>
                    $a->where('author_name', $author)
                )
            )

            ->get();

        if ($offers->isNotEmpty()) {
            $demand->demand_status = 't';
            $demand->save();
        }

        
        /*// 1) A demand mezői
        $publisherName = $demand->publisher;        // string
        $title         = $demand->title;            // string
        $genreId       = $demand->genre_id;         // int|null
        $authorName    = $demand->author;           // string|null
        $language      = $demand->language;         // string|null
        $minYear       = $demand->min_publication_year;
        $maxYear       = $demand->max_publication_year;

        // 2) Összeegyeztetés az offers táblával
        $offers = BookOffer::query()
            // publisher FK alapján: join Publisher → publisher_name
            ->whereHas('publisher', fn($q) =>
                $q->where('publisher_name', $publisherName)
            )

            // cím: join Work → title
            ->whereHas('work', fn($q) =>
                $q->where('title', $title)
            )

            // genre
            ->when($genreId, fn($q) =>
                $q->whereHas('work', fn($w) =>
                    $w->where('genre_id', $genreId)
                )
            )

            // author: join pivot Work→Author, match author_name
            ->when($authorName, fn($q) =>
                $q->whereHas('work.authors', fn($a) =>
                    $a->where('author_name', $authorName)
                )
            )

            // language
            ->when($language, fn($q) =>
                $q->where('language', $language)
            )

            // publication_year intervallum
            ->when($minYear, fn($q) =>
                $q->where('publication_year', '>=', $minYear)
            )
            ->when($maxYear, fn($q) =>
                $q->where('publication_year', '<=', $maxYear)
            )

            ->get();

        // 3) Ha találat, matched
        if ($offers->isNotEmpty()) {
            $demand->demand_status = 'matched';
            $demand->save();
        }
        /*$offers = BookOffer::query()
            ->when($demand->publisher_id, fn($q) =>
                $q->where('publisher_id', $demand->publisher_id)
            )
            ->when($demand->work && $demand->work->genre_id, fn($q) =>
                $q->whereHas('work', fn($w) =>
                    $w->where('genre_id', $demand->work->genre_id)
                )
            )
            ->when($demand->work && $demand->work->title, fn($q) =>
                $q->whereHas('work', fn($w) =>
                    $w->where('title', $demand->work->title)
                )
            )
            ->when($demand->work->author_id->isNotEmpty(), fn($q) =>
                $q->whereHas('work.authors', fn($a) =>
                    $a->whereIn('author_id',
                        $demand->work->author_id->pluck('author_id')->all()
                    )
                )
            )
            ->when($demand->language, fn($q) =>
                $q->where('language', $demand->language)
            )
            ->when($demand->min_publication_year, fn($q) =>
                $q->where('publication_year', '>=', $demand->min_publication_year)
            )
            ->when($demand->max_publication_year, fn($q) =>
                $q->where('publication_year', '<=', $demand->max_publication_year)
            )
            ->get();

        if ($offers->isNotEmpty()) {
            $demand->demand_status = 't';
            $demand->save();
            /*Notification::send(
                $demand->user,
                new BookMatched($offers, $demand)
            );
        }*/
    }

    /**
     * Handle the BookDemand "updated" event.
     */
    public function updated(BookDemand $bookDemand): void
    {
        //
    }

    /**
     * Handle the BookDemand "deleted" event.
     */
    public function deleted(BookDemand $bookDemand): void
    {
        //
    }

    /**
     * Handle the BookDemand "restored" event.
     */
    public function restored(BookDemand $bookDemand): void
    {
        //
    }

    /**
     * Handle the BookDemand "force deleted" event.
     */
    public function forceDeleted(BookDemand $bookDemand): void
    {
        //
    }
}
