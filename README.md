# QuickieTech
Code Base for Technopreneurship

<br><br>
For EmailVerificationRequest, replace the existing authorize function with this one

    public function authorize()
    {
        $userId = $this->route('id');
        $userHash = $this->route('hash');
    
        // Retrieve the user by ID
        $user = User::find($userId);
    
        // Check if the user exists and the hash matches
        if (!$user || !hash_equals(sha1($user->getEmailForVerification()), (string) $userHash)) {
            return true;
        }
    
        return true;
    }

<br><br>
Ensure to replace the necessary details of MAIL_MAILER on env file too
