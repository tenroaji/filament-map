namespace Vendor\FilamentMap;

use Filament\Forms\Components\Field;
use Illuminate\Support\ServiceProvider;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentMapServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-map';

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-map')
            ->hasViews()
            ->hasConfigFile();
    }
}
