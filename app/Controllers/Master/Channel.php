<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\ChannelModel;

class Channel extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $channelModel = new ChannelModel();

        $channels = $channelModel
            ->where('business_id', session()->get('business_id'))
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('master/channel/index', [
            'channels' => $channels,
        ]);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('master/channel/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $name = trim((string) $this->request->getPost('name'));

        if ($name === '') {
            return redirect()
                ->to('/channels/create')
                ->withInput()
                ->with('error', 'Nama channel wajib diisi.');
        }

        $channelModel = new ChannelModel();

        $channelModel->insert([
            'business_id' => session()->get('business_id'),
            'name'        => $name,
        ]);

        return redirect()
            ->to('/channels')
            ->with('success', 'Channel berhasil ditambahkan.');
    }
}