<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'value',
        'title',
        'user_id'
    ];


    public function recentGalery($atts = array())
    {

        $limit = $atts['limit'];
        $order = $atts['order'];
        $orderby = $atts['orderby'];

        $galeri_query = Galeri::query();

        // if(!optional(Auth::user())->hasRole(config('constants.roles.admin'))) {
        //     $galeri_query->where('visibility', '!=', 'Pr');
        // }
        $galeri_query->limit($limit)
                     ->orderBy($orderby, $order);
        $galeri = $galeri_query->get();
        return $galeri;

    }
}
