@extends('layouts.home')

@section('content')
<div class="generic-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="generic-card">
            <div class="generic-header">
                <h1>Hozana Game</h1>
                @if(isset($card['gameType']))
                    <div class="game-type-badge">{{ $card['gameType'] }}</div>
                @endif
                @if(isset($card['description']))
                    <p class="description">{{ $card['description'] }}</p>
                @endif
            </div>
            
            @if(isset($card['question']))
                <div class="generic-content">
                    <div class="question-container">
                        <h2>Question</h2>
                        <p>{{ $card['question']['content'] }}</p>
                    </div>
                    
                    @if($card['question']['type'] === 'choice')
                        <div class="choices-container">
                            <h3>Options</h3>
                            <ul class="choices-list">
                                @foreach($card['question']['choices'] as $index => $choice)
                                    <li class="choice-item">
                                        <div class="choice-dot" style="background-color: {{ ['#9c27b0', '#673ab7', '#3f51b5', '#2196f3'][$index % 4] }}"></div>
                                        <span>{{ $choice }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="hint-box">
                                <span class="hint-icon">💡</span>
                                <p>
                                    La solution suggérée est
                                    <span class="hint-dot" style="background-color: {{ ['#9c27b0', '#673ab7', '#3f51b5', '#2196f3'][$card['question']['correctChoice'] % 4] }}"></span>
                                </p>
                            </div>
                        </div>
                    @endif
                    
                    @if($card['question']['type'] === 'free' && isset($card['question']['answer']))
                        <div class="answer-container">
                            <div class="answer-header">
                                <h3>Réponse</h3>
                                <span class="answer-icon">✓</span>
                            </div>
                            <p>{{ $card['question']['answer'] }}</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="empty-content">
                    <div class="empty-icon">❓</div>
                    <p>Cette carte ne contient pas de contenu spécifique.</p>
                </div>
            @endif
            
            <!--div class="card-metadata">
                <div class="qr-code">
                    <div class="qr-image">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ url()->current() }}" alt="QR Code">
                    </div>
                    <div class="qr-info">
                        <p>Scannez pour partager</p>
                    </div>
                </div>
                
                <div class="card-info">
                    <div class="info-item">
                        <span class="info-label">Type:</span>
                        <span class="info-value">{{ $card['gameType'] ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Code:</span>
                        <span class="info-value">{{ request()->segment(count(request()->segments())) }}</span>
                    </div>
                </div>
            </div-->
            
            <div class="generic-actions">
                <a href="{{ url('/') }}" class="btn-back">Retour à l'accueil</a>
                <a href="{{ url('/games') }}" class="btn-share">Voir tous les jeux</a>
            </div>
            
            <div class="generic-footer">
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
    .generic-page {
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
        background: linear-gradient(135deg, #e0e0e0 0%, #757575 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte générique */
    .generic-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .generic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .generic-header {
        background-color: #607d8b;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .generic-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .generic-logo {
        margin-bottom: 15px;
    }
    
    .generic-logo img {
        height: 60px;
        width: auto;
    }
    
    .generic-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .game-type-badge {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.3);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .generic-header p.description {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Contenu */
    .generic-content {
        padding: 30px;
    }
    
    .question-container {
        background-color: #eceff1;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 5px solid #607d8b;
    }
    
    .question-container h2 {
        color: #455a64;
        font-size: 22px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .question-container h2::before {
        content: '?';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #607d8b;
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    
    .question-container p {
        font-size: 18px;
        line-height: 1.6;
        color: #333;
    }
    
    /* Choix */
    .choices-container {
        padding: 20px;
    }
    
    .choices-container h3 {
        color: #455a64;
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
        background-color: #eceff1;
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
        background-color: #e0f7fa;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        border: 1px dashed #00bcd4;
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
    
    /* Réponse */
    .answer-container {
        background-color: #e0f2f1;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
        border-left: 5px solid #009688;
    }
    
    .answer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .answer-header h3 {
        color: #00796b;
        font-size: 20px;
    }
    
    .answer-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #009688;
        color: white;
        border-radius: 50%;
        font-size: 16px;
    }
    
    .answer-container p {
        font-size: 18px;
        line-height: 1.5;
        color: #333;
    }
    
    /* Contenu vide */
    .empty-content {
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
    
    .empty-content p {
        font-size: 18px;
        color: #455a64;
    }
    
    /* Métadonnées */
    .card-metadata {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 30px;
        background-color: #f5f5f5;
        margin: 0 30px 30px;
        border-radius: 16px;
    }
    
    .qr-code {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .qr-image img {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        border: 5px solid white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .qr-info {
        margin-top: 10px;
        font-size: 12px;
        color: #607d8b;
    }
    
    .card-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .info-item {
        display: flex;
        gap: 5px;
    }
    
    .info-label {
        font-weight: 600;
        color: #607d8b;
    }
    
    .info-value {
        color: #455a64;
    }
    
    /* Actions */
    .generic-actions {
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
        background-color: #607d8b;
        color: white;
        box-shadow: 0 4px 12px rgba(96, 125, 139, 0.3);
    }
    
    .btn-back:hover {
        background-color: #455a64;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(96, 125, 139, 0.4);
    }
    
    .btn-share {
        background-color: white;
        color: #607d8b;
        border: 2px solid #607d8b;
    }
    
    .btn-share:hover {
        background-color: #eceff1;
        transform: translateY(-3px);
    }
    
    /* Pied de page */
    .generic-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .generic-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .generic-header {
            padding: 20px;
        }
        
        .generic-header h1 {
            font-size: 26px;
        }
        
        .generic-content {
            padding: 20px;
        }
        
        .question-container {
            padding: 20px;
        }
        
        .card-metadata {
            flex-direction: column;
            gap: 20px;
        }
        
        .generic-actions {
            flex-direction: column;
        }
        
        .btn-back, .btn-share {
            width: 100%;
        }
    }
</style>
@endsection