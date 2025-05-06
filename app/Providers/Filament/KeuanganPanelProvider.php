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
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use App\Filament\Resources\ReimburseResource;
use App\Models\Reimburse;
use App\Filament\Resources\SouvenirResource;
use App\Models\Souvenir;
use App\Filament\Resources\BBMResource;
use App\Models\Bbm;
use Filament\Navigation\MenuItem;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class KeuanganPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->maxContentWidth('full')
            ->sidebarWidth('auto')
            ->sidebarCollapsibleOnDesktop(true)
            ->brandLogo(asset('storage/img/logo_smg.png'))
            ->id('keuangan')
            ->path('keuangan')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                ReimburseResource::class,
                SouvenirResource::class,
                BBMResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Keuangan/Resources'), for: 'App\\Filament\\Keuangan\\Resources')
            ->discoverPages(in: app_path('Filament/Keuangan/Pages'), for: 'App\\Filament\\Keuangan\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
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
            // ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            //     return $builder->groups([
            //         NavigationGroup::make('Dashboard')
            //             ->items([
            //                 NavigationItem::make('Dashboard')
            //                     ->icon('heroicon-o-home')
            //                     ->isActiveWhen(fn(): bool => request()->routeIs('filament.keuangan.pages.dashboard'))
            //                     ->url(fn(): string => Dashboard::getUrl()),
            //             ]),
            //         NavigationGroup::make('Reimburse')
            //         ->items([
            //             ...ReimburseResource::getNavigationItems(),
            //             // ...SouvenirResource::getNavigationItems(),
            //             // ...BBMResource::getNavigationItems(),
                        
            //         ]),
            //     ]);
            // })
            ;
    }
}
