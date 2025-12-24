@extends('layouts.home')

@section('content')
<div class="quiz-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="quiz-card">
            <div class="quiz-header">
                <h1>Hozana Quiz</h1>
                @if(isset($card['description']))
                    <p class="description">{{ $card['description'] }}</p>
                @endif
            </div>
            
            @if(isset($card['question']))
                <div class="quiz-content">
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
                                        <div class="choice-dot" style="background-color: {{ ['#e53935', '#43a047', '#1e88e5', '#ffb300'][$index % 4] }}"></div>
                                        <span>{{ $choice }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <div class="hint-box">
                                <span class="hint-icon">💡</span>
                                <p>
                                    La bonne réponse est
                                    <span class="hint-dot" style="background-color: {{ ['#e53935', '#43a047', '#1e88e5', '#ffb300'][$card['question']['correctChoice'] % 4] }}"></span>
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
                <div class="empty-question">
                    <div class="empty-icon">❓</div>
                    <p>Cette carte ne contient pas de question.</p>
                </div>
            @endif
            
            <div class="quiz-actions">
                <a href="{{ url('/game/quiz') }}" class="btn-back">Retour aux règles du jeu</a>
            </div>
            
            <div class="quiz-footer">
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
    .quiz-page {
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
        background: linear-gradient(135deg, #bbdefb 0%, #2196f3 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte de quiz */
    .quiz-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .quiz-header {
        background-color: #1976d2;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .quiz-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .quiz-logo {
        margin-bottom: 15px;
    }
    
    .quiz-logo img {
        height: 60px;
        width: auto;
    }
    
    .quiz-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    .quiz-header p.description {
        font-size: 18px;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Contenu */
    .quiz-content {
        padding: 30px;
    }
    
    .question-container {
        background-color: #e3f2fd;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 5px solid #1976d2;
    }
    
    .question-container h2 {
        color: #0d47a1;
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
        background-color: #1976d2;
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
        color: #0d47a1;
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
        background-color: #e3f2fd;
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
        background-color: #fff8e1;
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
    
    /* Réponse */
    .answer-container {
        background-color: #e8f5e9;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
        border-left: 5px solid #43a047;
    }
    
    .answer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    
    .answer-header h3 {
        color: #1b5e20;
        font-size: 20px;
    }
    
    .answer-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background-color: #43a047;
        color: white;
        border-radius: 50%;
        font-size: 16px;
    }
    
    .answer-container p {
        font-size: 18px;
        line-height: 1.5;
        color: #333;
    }
    
    /* Pas de question */
    .empty-question {
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
    
    .empty-question p {
        font-size: 18px;
        color: #455a64;
    }
    
    /* Actions */
    .quiz-actions {
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
        background-color: #2196f3;
        color: white;
    }
    
    .btn-back:hover {
        background-color: #1976d2;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(33, 150, 243, 0.4);
    }
    
    .btn-share {
        background-color: white;
        color: #2196f3;
        border: 2px solid #2196f3;
    }
    
    .btn-share:hover {
        background-color: #f1f8ff;
        transform: translateY(-3px);
    }
    
    /* Pied de page */
    .quiz-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .quiz-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .quiz-header {
            padding: 20px;
        }
        
        .quiz-header h1 {
            font-size: 26px;
        }
        
        .quiz-content {
            padding: 20px;
        }
        
        .question-container {
            padding: 20px;
        }
        
        .quiz-actions {
            flex-direction: column;
        }
        
        .btn-back, .btn-share {
            width: 100%;
        }
    }
</style>

<script>
@endsection