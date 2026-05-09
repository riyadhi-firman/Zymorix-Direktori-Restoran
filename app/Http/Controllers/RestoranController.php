<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestoranController extends Controller
{
    private function getData()
    {
        $restoran = [
            ['id'=>1,'nama'=>'Warung Makan Sederhana','kota'=>'Serang','tipe_masakan'=>'Rumahan','rating'=>4.5,'menu_ids'=>[101,102,103]],
            ['id'=>2,'nama'=>'Sushi Japan','kota'=>'Serang','tipe_masakan'=>'Rumahan','rating'=>4.7,'menu_ids'=>[104,105,106]],
            ['id'=>3,'nama'=>'Steak House','kota'=>'Cilegon','tipe_masakan'=>'Western','rating'=>4.6,'menu_ids'=>[107,108]],
            ['id'=>4,'nama'=>'Bakso Pak Man','kota'=>'Pandeglang','tipe_masakan'=>'Indonesia','rating'=>4.3,'menu_ids'=>[109,110]],
            ['id'=>5,'nama'=>'Padang Merdeka','kota'=>'Rangkasbitung','tipe_masakan'=>'Padang','rating'=>4.8,'menu_ids'=>[111,112]],
        ];

        $menu = [
            ['id'=>101,'nama'=>'Nasi Goreng','kategori'=>'Makanan','harga'=>25000,'rating'=>4.7,'restoran_id'=>1],
            ['id'=>102,'nama'=>'Mie Goreng','kategori'=>'Makanan','harga'=>20000,'rating'=>4.5,'restoran_id'=>1],
            ['id'=>103,'nama'=>'Es Teh','kategori'=>'Minuman','harga'=>5000,'rating'=>4.2,'restoran_id'=>1],

            ['id'=>104,'nama'=>'Salmon Roll','kategori'=>'Makanan','harga'=>50000,'rating'=>4.8,'restoran_id'=>2],
            ['id'=>105,'nama'=>'Miso Soup','kategori'=>'Makanan','harga'=>30000,'rating'=>4.4,'restoran_id'=>2],
            ['id'=>106,'nama'=>'Green Tea','kategori'=>'Minuman','harga'=>20000,'rating'=>4.6,'restoran_id'=>2],

            ['id'=>107,'nama'=>'Sirloin Steak','kategori'=>'Makanan','harga'=>120000,'rating'=>4.9,'restoran_id'=>3],
            ['id'=>108,'nama'=>'Lemonade','kategori'=>'Minuman','harga'=>15000,'rating'=>4.3,'restoran_id'=>3],

            ['id'=>109,'nama'=>'Bakso Urat','kategori'=>'Makanan','harga'=>18000,'rating'=>4.5,'restoran_id'=>4],
            ['id'=>110,'nama'=>'Es Jeruk','kategori'=>'Minuman','harga'=>8000,'rating'=>4.2,'restoran_id'=>4],

            ['id'=>111,'nama'=>'Rendang','kategori'=>'Makanan','harga'=>35000,'rating'=>4.9,'restoran_id'=>5],
            ['id'=>112,'nama'=>'Teh Tarik','kategori'=>'Minuman','harga'=>12000,'rating'=>4.6,'restoran_id'=>5],
        ];

        return [$restoran, $menu];
    }

    public function home()
    {
        [$restoran, $menu] = $this->getData();

        return view('home', compact('restoran','menu'));
    }

    public function restoranIndex(Request $request)
    {
        [$restoran, $menu] = $this->getData();

        // SEARCH
        if ($request->search) {
            $restoran = collect($restoran)->filter(function ($r) use ($request) {
                return str_contains(strtolower($r['nama']), strtolower($request->search))
                    || str_contains(strtolower($r['kota']), strtolower($request->search));
            });
        }

        // SORT
        if ($request->sort == 'rating') {
            $restoran = collect($restoran)->sortByDesc('rating');
        }

        return view('restoran.index', compact('restoran'));
    }

    public function restoranShow($id)
    {
        [$restoran, $menu] = $this->getData();

        $data = collect($restoran)->firstWhere('id', $id);
        $menus = collect($menu)->where('restoran_id', $id);

        return view('restoran.show', compact('data','menus'));
    }

    public function menuIndex(Request $request)
    {
        [$restoran, $menu] = $this->getData();

        if ($request->search) {
            $menu = collect($menu)->filter(fn($m) =>
                str_contains(strtolower($m['nama']), strtolower($request->search))
            );
        }

        if ($request->kategori) {
            $menu = collect($menu)->where('kategori', $request->kategori);
        }

        return view('menu.index', compact('menu'));
    }

    public function menuShow($id)
    {
        [$restoran, $menu] = $this->getData();

        $data = collect($menu)->firstWhere('id', $id);
        $resto = collect($restoran)->firstWhere('id', $data['restoran_id']);

        return view('menu.show', compact('data','resto'));
    }
}