<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }

    public function todasLidas()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notificacao){
            $notificacao->markAsread();
        });

        flash('Notificações lidas com sucesso')->success();
        return redirect()->back();
    }

    public function ler($notificacao)
    {
        $notificacao = auth()->user()->notifications()->find($notificacao);
        $notificacao->markAsRead();
        flash('Notificação lida com sucesso')->success();
        return redirect()->back();
    }
}
