<?php

namespace Tenroaji\FilamentMap\Forms\Components;

use Filament\Forms\Components\Field;

class MapField extends Field
{
    protected string $view = 'filament-map::forms.components.map-field';

    protected bool $enableCurrentLocation = true;
    protected bool $enableDragMarker = true;
    protected float $defaultLat = -6.200000;
    protected float $defaultLng = 106.816666;
    protected int $defaultZoom = 13;

    public function enableCurrentLocation(bool $condition = true): static
    {
        $this->enableCurrentLocation = $condition;
        return $this;
    }

    public function enableDragMarker(bool $condition = true): static
    {
        $this->enableDragMarker = $condition;
        return $this;
    }

    public function defaultLocation(float $lat, float $lng): static
    {
        $this->defaultLat = $lat;
        $this->defaultLng = $lng;
        return $this;
    }

    public function zoom(int $level): static
    {
        $this->defaultZoom = $level;
        return $this;
    }

    protected function getDefaultState(): array
    {
        return [
            'lat' => $this->defaultLat,
            'lng' => $this->defaultLng,
        ];
    }
} 