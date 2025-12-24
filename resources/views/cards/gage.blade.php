@extends('layouts.home')

@section('content')
<div class="gage-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="gage-card">
            <div class="gage-header">
                <h1>Hozana Gage</h1>
                @if(isset($card['description']))
                    <p class="description">{{ $card['description'] }}</p>
                @endif
            </div>
            
            @if(isset($card['question']))
                <div class="gage-content">
                    <div class="gage-instruction">
                        <h2>Gage à réaliser</h2>
                        <p>{{ $card['question']['content'] }}</p>
                    </div>
                    
                    @if($card['question']['type'] === 'choice')
                        <div class="choices-container">
                            <h3>Options</h3>
                            <ul class="choices-list">
                                @foreach($card['question']['choices'] as $index => $choice)
                                    <li class="choice-item">
                                        <div class="choice-dot" style="background-color: {{ ['#2e7d32', '#388e3c', '#43a047', '#4caf50'][$index % 4] }}"></div>
                                        <span>{{ $choice }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="hint-box">
                                <span class="hint-icon">💡</span>
                                <p>
                                    L'option suggérée est
                                    <span class="hint-dot" style="background-color: {{ ['#2e7d32', '#388e3c', '#43a047', '#4caf50'][$card['question']['correctChoice'] % 4] }}"></span>
                                </p>
                            </div>
                        </div>
                    @endif
                    
                    @if($card['question']['type'] === 'free' && isset($card['question']['answer']))
                        <div class="info-container">
                            <div class="info-header">
                                <h3>Précisions</h3>
                                <span class="info-icon">ℹ️</span>
                            </div>
                            <p>{{ $card['question']['answer'] }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-instruction">
                    <div class="empty-icon">🎮</div>
                    <p>Cette carte ne contient pas de gage.</p>
                </div>
            @endif
            
            <div class="challenge-box">
                <!--div class="level-indicator">
                    <span class="level-label">Difficulté:</span>
                    <div class="level-dots">
                        <span class="level-dot active"></span>
                        <span class="level-dot active"></span>
                        <span class="level-dot"></span>
                    </div>
                    <span class="level-text">Moyen</span>
                </div-->
                
                <div class="completion-tracker">
                    <button id="completed-btn" class="completion-btn">
                        ✓ Marquer comme réalisé
                    </button>
                </div>
            </div>
            
            <div class="gage-actions">
                <a href="{{ url('/game/gage') }}" class="btn-back">Retour aux règles du jeu</a>
            </div>
            
            <div class="gage-footer">
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
    .gage-page {
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
        background: linear-gradient(135deg, #c8e6c9 0%, #4caf50 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte de gage */
    .gage-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .gage-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .gage-header {
        background-color: #43a047;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .gage-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .gage-logo {
        margin-bottom: 15px;
    }
    
    .gage-logo img {
        height: 60px;
        width: auto;
    }
    
    .gage-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .gage-header p.description {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Contenu */
    .gage-content {
        padding: 30px;
    }
    
    .gage-instruction {
        background-color: #e8f5e9;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 5px solid #43a047;
    }
    
    .gage-instruction h2 {
        color: #2e7d32;
        font-size: 22px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .gage-instruction h2::before {
        content: '🎯';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #43a047;
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    .gage-instruction p {
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
        color: #2e7d32;
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
        background-color: #e8f5e9;
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
        background-color: #f1f8e9;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        border: 1px dashed #4caf50;
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
    
    /* Infos */
    .info-container {
        background-color: #dcedc8;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
        border-left: 5px solid #8bc34a;
    }
    
    .info-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .info-header h3 {
        color: #33691e;
        font-size: 20px;
    }
    
    .info-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #8bc34a;
        color: white;
        border-radius: 50%;
        font-size: 16px;
    }
    
    .info-container p {
        font-size: 18px;
        line-height: 1.5;
        color: #333;
    }
    
    /* Boîte de défi */
    .challenge-box {
        background-color: #fafafa;
        padding: 20px;
        border-radius: 16px;
        margin: 0 30px 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .level-indicator {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .level-label {
        font-size: 16px;
        font-weight: 600;
        color: #555;
    }
    
    .level-dots {
        display: flex;
        gap: 5px;
    }
    
    .level-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #e0e0e0;
    }
    
    .level-dot.active {
        background-color: #4caf50;
    }
    
    .level-text {
        font-size: 14px;
        color: #555;
    }
    
    .completion-tracker {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
    
    .completion-btn {
        background-color: #f1f8e9;
        color: #33691e;
        border: 2px solid #4caf50;
        border-radius: 30px;
        padding: 10px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .completion-btn:hover, .completion-btn.completed {
        background-color: #4caf50;
        color: white;
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
    .gage-actions {
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
        background-color: #4caf50;
        color: white;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }
    
    .btn-back:hover {
        background-color: #388e3c;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(76, 175, 80, 0.4);
    }
    
    .btn-share {
        background-color: white;
        color: #4caf50;
        border: 2px solid #4caf50;
    }
    
    .btn-share:hover {
        background-color: #f1f8e9;
        transform: translateY(-3px);
    }
    
    /* Pied de page */
    .gage-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .gage-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .gage-header {
            padding: 20px;
        }
        
        .gage-header h1 {
            font-size: 26px;
        }
        
        .gage-content {
            padding: 20px;
        }
        
        .gage-instruction {
            padding: 20px;
        }
        
        .gage-actions {
            flex-direction: column;
        }
        
        .btn-back, .btn-share {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const completedBtn = document.getElementById('completed-btn');
    
    completedBtn.addEventListener('click', function() {
        if (completedBtn.classList.contains('completed')) {
            completedBtn.classList.remove('completed');
            completedBtn.textContent = '✓ Marquer comme réalisé';
        } else {
            completedBtn.classList.add('completed');
            completedBtn.textContent = '✓ Gage réalisé !';
            
            // Afficher une animation de confettis (optionnel)
            showConfetti();
        }
    });
    
    function showConfetti() {
        const confettiCount = 200;
        const confettiContainer = document.createElement('div');
        confettiContainer.className = 'confetti-container';
        document.body.appendChild(confettiContainer);
        
        const colors = ['#4caf50', '#8bc34a', '#cddc39', '#ffeb3b', '#1b5e20'];
        
        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            confetti.style.animationDelay = Math.random() * 5 + 's';
            confettiContainer.appendChild(confetti);
        }
        
        setTimeout(() => {
            confettiContainer.remove();
        }, 8000);
    }
});
</script>

<style>
/* Animation confettis */
.confetti-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 9999;
    overflow: hidden;
}

.confetti {
    position: absolute;
    top: -10px;
    width: 10px;
    height: 10px;
    border-radius: 2px;
    animation: confetti-fall linear forwards;
}

@keyframes confetti-fall {
    0% {
        transform: translateY(-10px) rotate(0deg);
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) rotate(720deg);
        opacity: 0;
    }
}
</style>
@endsection