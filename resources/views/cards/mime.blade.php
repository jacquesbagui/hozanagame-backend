@extends('layouts.home')

@section('content')
<div class="mime-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="mime-card">
            <div class="mime-header">
                <h1>Hozana Mimes</h1>
                @if(isset($card['description']))
                    <p class="description">{{ $card['description'] }}</p>
                @endif
            </div>
            
            @if(isset($card['question']))
                <div class="mime-content">
                    <div class="mime-instruction">
                        <h2>À mimer</h2>
                        <p>{{ $card['question']['content'] }}</p>
                    </div>
                    
                    @if($card['question']['type'] === 'choice')
                        <div class="choices-container">
                            <h3>Options</h3>
                            <ul class="choices-list">
                                @foreach($card['question']['choices'] as $index => $choice)
                                    <li class="choice-item">
                                        <div class="choice-dot" style="background-color: {{ ['#e65100', '#d84315', '#ff5722', '#ff7043'][$index % 4] }}"></div>
                                        <span>{{ $choice }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="hint-box">
                                <span class="hint-icon">💡</span>
                                <p>
                                    L'option suggérée est
                                    <span class="hint-dot" style="background-color: {{ ['#e65100', '#d84315', '#ff5722', '#ff7043'][$card['question']['correctChoice'] % 4] }}"></span>
                                </p>
                            </div>
                        </div>
                    @endif
                    
                    @if($card['question']['type'] === 'free' && isset($card['question']['answer']))
                        <div class="hints-container">
                            <div class="hints-header">
                                <h3>Indices supplémentaires</h3>
                                <span class="hints-icon">🔍</span>
                            </div>
                            <p>{{ $card['question']['answer'] }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-instruction">
                    <div class="empty-icon">🎭</div>
                    <p>Cette carte ne contient pas d'instruction à mimer.</p>
                </div>
            @endif
            
            <!--div class="timer-section">
                <h3>Chronomètre</h3>
                <div class="timer-display">
                    <span id="timer-minutes">00</span>:<span id="timer-seconds">30</span>
                </div>
                <div class="timer-controls">
                    <button id="timer-start" class="timer-btn timer-start">Démarrer</button>
                    <button id="timer-reset" class="timer-btn timer-reset">Réinitialiser</button>
                </div>
            </div-->
            
            <div class="mime-actions">
                <a href="{{ url('/game/mime') }}" class="btn-back">Retour aux règles du jeu</a>
            </div>
            
            <div class="mime-footer">
                <img src="{{asset('images/logo-hozana-game.svg')}}" alt="Hozana" width="80">
                <p>Édition 2025</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Réinitialisation de base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Styles globaux de la page */
    .mime-page {
        min-height: 100vh;
        width: 100%;
        position: relative;
        font-family: 'Poppins', 'Helvetica Neue', sans-serif;
        color: #333;
        padding: 40px 20px;
        overflow-x: hidden;
    }
    
    .bg-gradient {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #ffccbc 0%, #ff5722 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte de mime */
    .mime-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .mime-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .mime-header {
        background-color: #6c9c83;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .mime-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .mime-logo {
        margin-bottom: 15px;
    }
    
    .mime-logo img {
        height: 60px;
        width: auto;
    }
    
    .mime-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .mime-header p.description {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Contenu */
    .mime-content {
        padding: 30px;
    }
    
    .mime-instruction {
        background-color: #e0e0b4;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 5px solid #6c9c83;
    }
    
    .mime-instruction h2 {
        color: #000;
        font-size: 22px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .mime-instruction h2::before {
        content: '🎭';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #6c9c83;
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    .mime-instruction p {
        font-size: 24px;
        line-height: 1.6;
        color: #333;
        font-weight: 600;
        text-align: center;
    }
    
    /* Choix */
    .choices-container {
        padding: 20px;
    }
    
    .choices-container h3 {
        color: #000;
        font-size: 20px;
        margin-bottom: 15px;
    }
    
    .choices-list {
        list-style: none;
        padding: 0;
        margin-bottom: 25px;
    }
    
    .choice-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        margin-bottom: 10px;
        background-color: #f5f5f5;
        border-radius: 10px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    
    .choice-item:hover {
        background-color: #fff3e0;
        transform: translateX(8px);
    }
    
    .choice-dot {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        margin-right: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .hint-box {
        background-color: #fbe9e7;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        border: 1px dashed #6c9c83;
    }
    
    .hint-icon {
        font-size: 22px;
        margin-right: 10px;
    }
    
    .hint-box p {
        font-size: 16px;
        margin: 0;
    }
    
    .hint-dot {
        display: inline-block;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        vertical-align: middle;
        margin-left: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    /* Indices */
    .hints-container {
        background-color: #ffccbc;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
        border-left: 5px solid #ff7043;
    }
    
    .hints-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .hints-header h3 {
        color: #000;
        font-size: 20px;
    }
    
    .hints-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #ff7043;
        color: white;
        border-radius: 50%;
        font-size: 16px;
    }
    
    .hints-container p {
        font-size: 18px;
        line-height: 1.5;
        color: #333;
    }
    
    /* Chronomètre */
    .timer-section {
        background-color: #fafafa;
        padding: 20px;
        border-radius: 16px;
        margin: 0 30px 30px;
        text-align: center;
    }
    
    .timer-section h3 {
        font-size: 20px;
        color: #6c9c83;
        margin-bottom: 10px;
    }
    
    .timer-display {
        font-size: 40px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        font-family: monospace;
    }
    
    .timer-controls {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    
    .timer-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .timer-start {
        background-color: #6c9c83;
        color: white;
    }
    
    .timer-start:hover {
        background-color: #6c9c83;
    }
    
    .timer-reset {
        background-color: #f5f5f5;
        color: #333;
    }
    
    .timer-reset:hover {
        background-color: #e0e0e0;
    }
    
    /* Pas d'instruction */
    .empty-instruction {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background-color: #f5f5f5;
        border-radius: 16px;
        margin: 30px;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 20px;
        color: #78909c;
    }
    
    .empty-instruction p {
        font-size: 18px;
        color: #455a64;
    }
    
    /* Actions */
    .mime-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 0 30px 30px;
    }
    
    .btn-back, .btn-share {
        display: inline-block;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
    }
    
    .btn-back {
        background-color: #6c9c83;
        color: white;
    }
    
    .btn-back:hover {
        background-color: #6c9c83;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 87, 34, 0.4);
    }
    
    .btn-share {
        background-color: white;
        color: #6c9c83;
        border: 2px solid #6c9c83;
    }
    
    .btn-share:hover {
        background-color: #fff3e0;
        transform: translateY(-3px);
    }
    
    /* Pied de page */
    .mime-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .mime-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .mime-header {
            padding: 20px;
        }
        
        .mime-header h1 {
            font-size: 26px;
        }
        
        .mime-content {
            padding: 20px;
        }
        
        .mime-instruction {
            padding: 20px;
        }
        
        .mime-actions {
            flex-direction: column;
        }
        
        .btn-back, .btn-share {
            width: 100%;
        }
    }
</style>

<script>
let timerInterval;
let timeLeft = 30;
let isRunning = false;

document.addEventListener('DOMContentLoaded', function() {
    const startBtn = document.getElementById('timer-start');
    const resetBtn = document.getElementById('timer-reset');
    const minutesDisplay = document.getElementById('timer-minutes');
    const secondsDisplay = document.getElementById('timer-seconds');
    
    startBtn.addEventListener('click', function() {
        if (isRunning) {
            // Pause
            clearInterval(timerInterval);
            startBtn.textContent = 'Démarrer';
            isRunning = false;
        } else {
            // Start/Resume
            startBtn.textContent = 'Pause';
            isRunning = true;
            
            timerInterval = setInterval(function() {
                timeLeft--;
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timeLeft = 0;
                    isRunning = false;
                    startBtn.textContent = 'Terminé';
                    startBtn.disabled = true;
                    
                    // Son de fin (optionnel)
                    const audio = new Audio('/sounds/timer-end.mp3');
                    audio.play().catch(e => console.log('Impossible de jouer le son:', e));
                }
                
                updateTimerDisplay();
            }, 1000);
        }
    });
    
    resetBtn.addEventListener('click', function() {
        clearInterval(timerInterval);
        timeLeft = 30;
        isRunning = false;
        startBtn.textContent = 'Démarrer';
        startBtn.disabled = false;
        updateTimerDisplay();
    });
    
    function updateTimerDisplay() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        minutesDisplay.textContent = String(minutes).padStart(2, '0');
        secondsDisplay.textContent = String(seconds).padStart(2, '0');
    }
});
</script>
@endsection