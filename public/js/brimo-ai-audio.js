/**
 * Brimo AI & Futuristic Web Audio Notification Sound Synthesizer
 * Generates crisp, futuristic AI notification sounds using Web Audio API natively.
 */

window.BrimoAudio = (function () {
    let audioCtx = null;

    function getAudioContext() {
        if (!audioCtx) {
            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
            if (AudioContextClass) {
                audioCtx = new AudioContextClass();
            }
        }
        if (audioCtx && audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
        return audioCtx;
    }

    /**
     * Signature BRImo AI Notification Chime
     * 3-tone sparkling hi-tech crystalline chime (E6 - B6 - E7) with FM modulation
     */
    function playBrimoAiSound() {
        const ctx = getAudioContext();
        if (!ctx) return;

        const now = ctx.currentTime;
        
        // Frequencies for BRImo AI Chime (E6: 1318Hz, B6: 1975Hz, E7: 2637Hz)
        const notes = [
            { freq: 1318.51, start: 0,    dur: 0.18, vol: 0.7 },
            { freq: 1975.53, start: 0.08, dur: 0.22, vol: 0.85 },
            { freq: 2637.02, start: 0.16, dur: 0.45, vol: 1.0 }
        ];

        notes.forEach(n => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();

            // Sine + subtle triangle overtone for crystalline AI tone
            osc.type = 'sine';
            osc.frequency.setValueAtTime(n.freq, now + n.start);
            
            // Fast attack, smooth exp decay
            gain.gain.setValueAtTime(0.001, now + n.start);
            gain.gain.linearRampToValueAtTime(n.vol, now + n.start + 0.015);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + n.start + n.dur);

            // Subtle frequency glide (AI pitch shimmer)
            osc.frequency.exponentialRampToValueAtTime(n.freq * 1.008, now + n.start + n.dur);

            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.start(now + n.start);
            osc.stop(now + n.start + n.dur + 0.05);
        });

        // Add sub-sparkle harmonic overlay
        const shimmerOsc = ctx.createOscillator();
        const shimmerGain = ctx.createGain();
        shimmerOsc.type = 'triangle';
        shimmerOsc.frequency.setValueAtTime(3520, now + 0.16); // A7 sparkle
        shimmerGain.gain.setValueAtTime(0.001, now + 0.16);
        shimmerGain.gain.linearRampToValueAtTime(0.25, now + 0.18);
        shimmerGain.gain.exponentialRampToValueAtTime(0.0001, now + 0.5);

        shimmerOsc.connect(shimmerGain);
        shimmerGain.connect(ctx.destination);
        shimmerOsc.start(now + 0.16);
        shimmerOsc.stop(now + 0.55);
    }

    /**
     * Futuristic Synth Pulse Sound
     */
    function playFuturisticSynth() {
        const ctx = getAudioContext();
        if (!ctx) return;
        const now = ctx.currentTime;

        const osc1 = ctx.createOscillator();
        const gain1 = ctx.createGain();
        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(880, now);
        osc1.frequency.exponentialRampToValueAtTime(1760, now + 0.1);
        gain1.gain.setValueAtTime(0.7, now);
        gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.35);

        osc1.connect(gain1);
        gain1.connect(ctx.destination);
        osc1.start(now);
        osc1.stop(now + 0.4);
    }

    /**
     * Classic Bell Chime Sound
     */
    function playClassicBell() {
        const ctx = getAudioContext();
        if (!ctx) return;
        const now = ctx.currentTime;

        [523.25, 659.25, 783.99].forEach((freq, i) => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(freq, now + i * 0.1);
            gain.gain.setValueAtTime(0.5, now + i * 0.1);
            gain.gain.exponentialRampToValueAtTime(0.001, now + i * 0.1 + 0.4);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start(now + i * 0.1);
            osc.stop(now + i * 0.1 + 0.45);
        });
    }

    /**
     * Gentle Chime Sound
     */
    function playChime() {
        const ctx = getAudioContext();
        if (!ctx) return;
        const now = ctx.currentTime;

        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'sine';
        osc.frequency.setValueAtTime(1046.50, now); // C6
        gain.gain.setValueAtTime(0.6, now);
        gain.gain.exponentialRampToValueAtTime(0.001, now + 0.5);
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.start(now);
        osc.stop(now + 0.55);
    }

    /**
     * Dispatch sound player based on type string
     */
    function playSound(soundType) {
        try {
            switch (soundType) {
                case 'futuristic_synth':
                    playFuturisticSynth();
                    break;
                case 'classic_bell':
                    playClassicBell();
                    break;
                case 'chime':
                    playChime();
                    break;
                case 'brimo_ai':
                default:
                    playBrimoAiSound();
                    break;
            }
        } catch (e) {
            console.error('BrimoAudio error:', e);
        }
    }

    return {
        playBrimoAiSound,
        playFuturisticSynth,
        playClassicBell,
        playChime,
        playSound
    };
})();
