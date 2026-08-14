<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Réinitialisation de votre mot de passe</h2>
    <p>Bonjour,</p>
    <p>Vous avez demandé un code de sécurité pour réinitialiser votre mot de passe sur l'application Visite Ouidah.</p>
    
    <div style="font-size: 24px; font-weight: bold; letter-spacing: 5px; padding: 15px; background-color: #f4f4f4; text-align: center; width: 180px; border-radius: 5px; margin: 20px 0; color: #1a73e8;">
        {{ $otpBrut }}
    </div>

    <p>Ce code est strictement confidentiel et expirera dans <strong>10 minutes</strong>.</p>
    <p>Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet e-mail.</p>
    <p>Cordialement,<br>L'équipe technique - Visite Ouidah</p>
</body>
</html>
