<?php

namespace App\Filament\Pages;

use App\Models\Company;
use Filament\Pages\Page;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;

use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\CreateAction;

class EditCompany extends Page implements HasForms, HasInfolists, HasActions
{
    use InteractsWithForms;
    use InteractsWithInfolists;
    use InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static string $view = 'filament.pages.edit-company';
    protected static ?string $title = 'My Company';

    public Company $company;

    public function mount(): void
    {
        $this->company = Company::first();
    }

    public function companyInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->company)
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->icon('heroicon-m-envelope'),
                TextEntry::make('address'),
                TextEntry::make('radius_km'),
                TextEntry::make('latitude'),
                TextEntry::make('longitude'),
                TextEntry::make('time_in'),
                TextEntry::make('time_out'),
                TextEntry::make('attendance_type'),
            ]);
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->form([
                TextInput::make('name')
                    ->required(),
                Textarea::make('address')
                    ->autosize()
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('radius_km')
                    ->numeric()
                    ->required(),
                TextInput::make('latitude')
                    ->numeric()
                    ->required(),
                TextInput::make('longitude')
                    ->numeric()
                    ->required(),
                TimePicker::make('time_in')
                    ->seconds(false)
                    ->required(),
                TimePicker::make('time_out')
                    ->seconds(false)
                    ->required(),
                Select::make('attendance_type')
                    ->options([
                        'Face' => 'Face Recognize',
                        'QR' => 'QR Code',
                        'None' => 'None',
                    ])
                    ->required(),
            ])
            ->fillForm($this->company->attributesToArray())
            ->action(function (array $data): void {
                $this->company->fill($data)->save();
            })
            ->slideOver();
    }
}
