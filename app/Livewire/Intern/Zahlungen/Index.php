<?php

namespace App\Livewire\Intern\Zahlungen;

use App\Models\Intern\Payment;
use Carbon\Carbon;
use DB;
use Livewire\Component;

class Index extends Component
{
    public $zahlungen;

    public $zahlungUpdate = '';

    public $zahlungGesamt;

    public $years;

    public function mount()
    {
        $this->zahlungUpdate = Carbon::now()->year;
    }

    public function pay($id, $status)
    {
        if ($status) {
            Payment::where('id', $id)->update(['bezahlt' => $status, 'date_of_payment' => now()->format('Y-m-d')]);
        } else {
            Payment::where('id', $id)->update(['bezahlt' => $status, 'date_of_payment' => null]);
        }

        return redirect(route('intern.zahlungen.index'));
    }

    public function render()
    {
        $this->zahlungen = json_encode(Payment::select('*', DB::raw('DATE(payment_for_month) as date'))
            ->whereLike(['payment_for_month'], $this->updatedZahlungUpdate())
            ->orderByDesc('payment_for_month')
            ->get()
            ->groupBy('date'), JSON_THROW_ON_ERROR);
        $this->zahlungGesamt = number_format(Payment::where('bezahlt', true)
            ->whereLike(['payment_for_month'], $this->updatedZahlungUpdate())->sum('betrag'), 2, ',', '.').' €';
        $this->years = Payment::selectRaw('year(payment_for_month) year')
            ->orderByDesc('year')
            ->groupBy('year')
            ->get();

        return view('livewire.intern.zahlungen.index');
    }

    public function updatedZahlungUpdate()
    {
        return $this->zahlungUpdate;
    }
}
