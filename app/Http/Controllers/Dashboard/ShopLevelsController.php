<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\LogHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShopLevel\UpdateRequest;
use App\Models\Shop;
use App\Models\ShopLevel;
use App\UseCases\ShopLevel\UpdateUseCase;
use Illuminate\Http\Request;

class ShopLevelsController extends Controller
{
    public function index(Request $request, Shop $shop)
    {
        $section = 'rewards';
        $types = Shoplevel::TYPES;

        if($request->ajax()) {
            $items = ShopLevel::where('shop_id', $shop->id)->orderBy('level')->get();

            return response()->json($items);
        }

        return view('dashboard.shop.panel.configurations.rewards', compact('shop', 'types', 'section'));
    }

    public function update(UpdateRequest $request, Shop $shop) {
        if ($shop->type === ShopLevel::TYPES['loop']) {
            $data = [
                'loop_icon' => $request->input('loop_icon'),
                'loop_reward' => $request->input('loop_reward'),
                'times_for_reward' => $request->input('times_for_reward')
            ];
        } else {
            $data = [
                'required_exp' =>  $request->input('required_exp'),
                'point_multiplier' => $request->input('point_multiplier')
            ];
        }

        $useCase = new UpdateUseCase(
            $shop,
            $request->input('type'),
            $data,
            $request->input('rewards') ?? []
        );
        $useCase->action();

        LogHelper::generateLog(
            'Shop Rewards Modified',
            $request->user(),
            $shop,
            'edit'
        );

        toast('Configuration Saved', 'success');

        return redirect()->route('dashboard.shop.panel.configuration.rewards.index', $shop->subdomain);
    }
}
