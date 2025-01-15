<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionRelationManager extends RelationManager
{
    protected static string $relationship = 'permission';

    public function form(Form $form): Form
    {
        return \App\Filament\Resources\PermissionResource::form($form);
    }

    public function table(Table $table): Table
    {
        return \App\Filament\Resources\PermissionResource::table($table);
    }
}
