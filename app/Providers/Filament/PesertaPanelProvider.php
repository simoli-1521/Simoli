<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Auth\CustomRegister;
use Filament\Navigation\MenuItem;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use App\Filament\Widgets\CelendarWidget;

use App\Filament\Resources\PenilaianPegawaiResource;
use App\Filament\Resources\BookRequestResource;

class PesertaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->maxContentWidth('full')
            ->sidebarWidth('auto')
            ->sidebarCollapsibleOnDesktop(true)
            ->brandLogo(asset('storage/img/logo_smg.png'))
            ->id('peserta')
            ->path('peserta')
            ->login()
            ->registration(CustomRegister::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                PenilaianPegawaiResource::class,
                BookRequestResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Peserta/Resources'), for: 'App\\Filament\\Peserta\\Resources')
            ->discoverPages(in: app_path('Filament/Peserta/Pages'), for: 'App\\Filament\\Peserta\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                CelendarWidget::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn(): string => Blade::render('@wirechatStyles'),
            )
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn(): string => Blade::render('@wirechatAssets'),
            )
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-user')
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars'
                    ),
                FilamentFullCalendarPlugin::make()
                    ->schedulerLicenseKey('')
                    // ->selectable(true)
                    // ->editable()
                    ->timezone(config('app.timezone'))
                    ->locale(config('app.locale'))
                    ->plugins(['dayGrid', 'timeGrid'])
                    ->config([])
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Edit profile')
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
