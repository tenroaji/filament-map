<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        wire:ignore
        x-data="{
            map: null,
            marker: null,
            lat: @entangle($getStatePath() . '.lat'),
            lng: @entangle($getStatePath() . '.lng'),
            init() {
                this.map = L.map($refs.map).setView([this.lat, this.lng], {{ $defaultZoom }});
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(this.map);

                this.marker = L.marker([this.lat, this.lng], {
                    draggable: {{ $enableDragMarker ? 'true' : 'false' }}
                }).addTo(this.map);

                @if($enableDragMarker)
                this.marker.on('dragend', (event) => {
                    const position = event.target.getLatLng();
                    this.lat = position.lat;
                    this.lng = position.lng;
                });
                @endif

                @if($enableCurrentLocation)
                $refs.currentLocation.addEventListener('click', () => {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const { latitude, longitude } = position.coords;
                        this.lat = latitude;
                        this.lng = longitude;
                        this.map.setView([latitude, longitude], {{ $defaultZoom }});
                        this.marker.setLatLng([latitude, longitude]);
                    });
                });
                @endif
            }
        }"
    >
        <div x-ref="map" style="height: 400px; min-width: 100%; margin-bottom: 1rem;"></div>
        
        @if($enableCurrentLocation)
        <button
            type="button"
            x-ref="currentLocation"
            class="filament-button filament-button-size-sm inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2rem] px-3 text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600"
        >
            Get Current Location
        </button>
        @endif
    </div>
</x-dynamic-component>

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush 