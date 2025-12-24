@extends('layouts.home')

@section('content')
<div class="error-page">
    <div class="bg-gradient"></div>
    <div class="container">
        <div class="error-card">
            <div class="error-header">
                <h1>Oups, une erreur est survenue !</h1>
            </div>
            
            <div class="error-content">
                <div class="error-illustration">
                    <div class="error-icon">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#FF5252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 9L9 15" stroke="#FF5252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 9L15 15" stroke="#FF5252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                
                <div class="error-details">
                    <h2>{{ $message ?? 'Carte non trouvée' }}</h2>
                    <p>{{ $code ? "Code recherché: {$code}" : 'Cette carte n\'existe pas ou a été désactivée.' }}</p>
                </div>
                
                <div class="error-suggestions">
                    <h3>Que faire maintenant?</h3>
                    <ul>
                        <li>Vérifiez que vous avez correctement scanné le QR code</li>
                        <li>Essayez à nouveau de scanner le code</li>
                        <li>Consultez les autres jeux Hozana disponibles</li>
                    </ul>
                </div>
            </div>
            
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn-home">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon">
                        <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Accueil
                </a>
                <a href="{{ url('/games') }}" class="btn-games">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-icon">
                        <path d="M17 3H7C5.89543 3 5 3.89543 5 5V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V5C19 3.89543 18.1046 3 17 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Voir nos jeux
                </a>
            </div>
            
            <div class="error-footer">
                <img src="{{asset('images/logo-hozana-game.svg')}}" alt="Hozana" width="80">
                <p>Si le problème persiste, contactez-nous à <a href="mailto:support@hozanagame.com">support@hozanagame.com</a></p>
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
    .error-page {
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
        background: linear-gradient(135deg, #ffebee 0%, #ef5350 100%);
        z-index: -1;
    }
    
    .container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }
    
    /* Carte d'erreur */
    .error-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        margin-bottom: 40px;
        transform: translateY(0);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .error-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(0, 0, 0, 0.18);
    }
    
    /* En-tête */
    .error-header {
        background-color: #f44336;
        padding: 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .error-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 20px;
        background-color: white;
        border-radius: 50% 50% 0 0;
    }
    
    .error-logo {
        margin-bottom: 15px;
    }
    
    .error-logo img {
        height: 60px;
        width: auto;
    }
    
    .error-header h1 {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }
    
    /* Contenu d'erreur */
    .error-content {
        padding: 30px;
    }
    
    .error-illustration {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }
    
    .error-icon {
        color: #f44336;
    }
    
    .error-details {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .error-details h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #d32f2f;
    }
    
    .error-details p {
        font-size: 18px;
        color: #555;
    }
    
    .error-suggestions {
        background-color: #fafafa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    
    .error-suggestions h3 {
        font-size: 18px;
        margin-bottom: 15px;
        color: #455a64;
    }
    
    .error-suggestions ul {
        padding-left: 20px;
    }
    
    .error-suggestions li {
        margin-bottom: 10px;
        color: #455a64;
    }
    
    /* Actions */
    .error-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 0 30px 30px;
    }
    
    .btn-home, .btn-games {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
    }
    
    .btn-home {
        background-color: #f44336;
        color: white;
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
    }
    
    .btn-home:hover {
        background-color: #d32f2f;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(244, 67, 54, 0.4);
    }
    
    .btn-games {
        background-color: white;
        color: #f44336;
        border: 2px solid #f44336;
    }
    
    .btn-games:hover {
        background-color: #ffebee;
        transform: translateY(-3px);
    }
    
    .btn-icon {
        display: inline-block;
    }
    
    /* Pied de page */
    .error-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .error-footer p {
        font-size: 14px;
        color: #78909c;
    }
    
    .error-footer a {
        color: #f44336;
        text-decoration: none;
        font-weight: 600;
    }
    
    .error-footer a:hover {
        text-decoration: underline;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .error-header {
            padding: 20px;
        }
        
        .error-header h1 {
            font-size: 24px;
        }
        
        .error-content {
            padding: 20px;
        }
        
        .error-actions {
            flex-direction: column;
        }
        
        .btn-home, .btn-games {
            width: 100%;
        }
    }
</style>
@endsection