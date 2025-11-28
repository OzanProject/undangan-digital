@props(['target'])

<section class="py-10 bg-blue-600 text-white text-center" x-data="countdown('{{ $target }}')">
    <h2 class="text-2xl mb-6 font-semibold">Menuju Acara</h2>
    <div class="flex justify-center gap-4 text-center">
        <div><span class="text-3xl font-bold block" x-text="days"></span> Hari</div>
        <div><span class="text-3xl font-bold block" x-text="hours"></span> Jam</div>
        <div><span class="text-3xl font-bold block" x-text="minutes"></span> Menit</div>
        <div><span class="text-3xl font-bold block" x-text="seconds"></span> Detik</div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('countdown', (expiry) => ({
            days: '00', hours: '00', minutes: '00', seconds: '00',
            init() {
                const endDate = new Date(expiry).getTime();
                setInterval(() => {
                    const now = new Date().getTime();
                    const diff = endDate - now;
                    if (diff > 0) {
                        this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        this.hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        this.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        this.seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    }
                }, 1000);
            }
        }))
    })
</script>