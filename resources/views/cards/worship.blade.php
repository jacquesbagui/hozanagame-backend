@extends('layouts.home')

@section('content')
<div class="worship-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="worship-card">
            <div class="worship-header">
                <h1>Hozana Worship</h1>
                @if(isset($card['description']))
                    <p class="description">{{ $card['description'] }}</p>
                @endif
            </div>
            
            @if(isset($card['question']))
                <div class="worship-content">
                    <div class="worship-instruction">
                        <h2>Moment d'adoration</h2>
                        <p>{{ $card['question']['content'] }}</p>
                    </div>
                    
                    @if($card['question']['type'] === 'choice')
                        <div class="choices-container">
                            <h3>Options</h3>
                            <ul class="choices-list">
                                @foreach($card['question']['choices'] as $index => $choice)
                                    <li class="choice-item">
                                        <div class="choice-dot" style="background-color: {{ ['#e65100', '#bf360c', '#ff8f00', '#f57c00'][$index % 4] }}"></div>
                                        <span>{{ $choice }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="hint-box">
                                <span class="hint-icon">💡</span>
                                <p>
                                    L'option suggérée est
                                    <span class="hint-dot" style="background-color: {{ ['#e65100', '#bf360c', '#ff8f00', '#f57c00'][$card['question']['correctChoice'] % 4] }}"></span>
                                </p>
                            </div>
                        </div>
                    @endif
                    
                    @if($card['question']['type'] === 'free' && isset($card['question']['answer']))
                        <div class="suggestion-container">
                            <div class="suggestion-header">
                                <h3>Suggestion</h3>
                                <span class="suggestion-icon">✨</span>
                            </div>
                            <p>{{ $card['question']['answer'] }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-instruction">
                    <div class="empty-icon">🎵</div>
                    <p>Cette carte ne contient pas d'instruction.</p>
                </div>
            @endif
            
            <div class="worship-actions">
                <a href="{{ url('/game/worship') }}" class="btn-back">Retour aux règles du jeu</a>
            </div>
            
            <div class="worship-footer">
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
    .worship-page {
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
        background: linear-gradient(135deg, #fff8e1 0%, #ff9800 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte de worship */
    .worship-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .worship-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .worship-header {
        background-color: #fb8c00;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .worship-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .worship-logo {
        margin-bottom: 15px;
    }
    
    .worship-logo img {
        height: 60px;
        width: auto;
    }
    
    .worship-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .worship-header p.description {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Contenu */
    .worship-content {
        padding: 30px;
    }
    
    .worship-instruction {
        background-color: #fff8e1;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 5px solid #fb8c00;
    }
    
    .worship-instruction h2 {
        color: #e65100;
        font-size: 22px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .worship-instruction h2::before {
        content: '♪';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #fb8c00;
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    .worship-instruction p {
        font-size: 18px;
        line-height: 1.6;
        color: #333;
    }
    
    /* Choix */
    .choices-container {
        padding: 20px;
    }
    
    .choices-container h3 {
        color: #e65100;
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
        background-color: #fff8e1;
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
        background-color: #fffde7;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        border: 1px dashed #ffb300;
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
    
    /* Suggestion */
    .suggestion-container {
        background-color: #fff3e0;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
        border-left: 5px solid #ff9800;
    }
    
    .suggestion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .suggestion-header h3 {
        color: #e65100;
        font-size: 20px;
    }
    
    .suggestion-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #ff9800;
        color: white;
        border-radius: 50%;
        font-size: 16px;
    }
    
    .suggestion-container p {
        font-size: 18px;
        line-height: 1.5;
        color: #333;
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
    .worship-actions {
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
        background-color: #ff9800;
        color: white;
    }
    
    .btn-back:hover {
        background-color: #f57c00;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(255, 152, 0, 0.4);
    }
    
    .btn-share {
        background-color: white;
        color: #ff9800;
        border: 2px solid #ff9800;
    }
    
    .btn-share:hover {
        background-color: #fff8e1;
        transform: translateY(-3px);
    }
    
    /* Pied de page */
    .worship-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .worship-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .worship-header {
            padding: 20px;
        }
        
        .worship-header h1 {
            font-size: 26px;
        }
        
        .worship-content {
            padding: 20px;
        }
        
        .worship-instruction {
            padding: 20px;
        }
        
        .worship-actions {
            flex-direction: column;
        }
        
        .btn-back, .btn-share {
            width: 100%;
        }
    }
</style>
@endsection