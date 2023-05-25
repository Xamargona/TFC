<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::all()->sortBy('date');
        foreach ($bookings as $booking) {
            $booking->date = date('d/m/Y', strtotime($booking->date));
        }
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role != 'artist') {
            return redirect()->back();
        }
        $booking = Booking::where([
            'session' => $request->session,
            'date' => $request->date,
        ])->first();

        if ($booking) {
            $bookings = Booking::all()->sortBy('date');
            foreach ($bookings as $booking) {
                $booking->date = date('d/m/Y', strtotime($booking->date));
            }
            return view('bookings.index', compact('bookings'))->with(['message' => 'Ya existe una reserva para esa fecha y sesión']);
        } else {
            $booking = new Booking;
            $booking->user_id = Auth::user()->id;
            $booking->session = $request->session;
            $booking->date = $request->date;
            $booking->save();

            $bookings = Booking::all()->sortBy('date');
            foreach ($bookings as $booking) {
                $booking->date = date('d/m/Y', strtotime($booking->date));
            }
            return view('bookings.index', compact('bookings'))->with(['message' => 'Reserva realizada correctamente']);        }
    }

    public function destroy(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role != 'artist') {
            return redirect()->back();
        }

        if (Auth::user()->id != $booking->user_id) {
            return redirect()->back();
        }

        $booking->delete();

        $bookings = Booking::all()->sortBy('date');
        foreach ($bookings as $booking) {
            $booking->date = date('d/m/Y', strtotime($booking->date));
        }
        return view('bookings.index', compact('bookings'))->with(['message' => 'Reserva eliminada correctamente']);
    }

}
