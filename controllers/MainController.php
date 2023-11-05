<?php
namespace App\Controllers;
use App\Core\Controller;

class MainController extends Controller {
    public function home()
    {
        $userId = $this->getSession()->get('user_id');
        $userForename = $this->getSession()->get('user_forename');
        $userSurname = $this->getSession()->get('user_surname');
        $role = $this->getSession()->get('role');

        if ($userId !== null) {
            $this->set('userId', $userId);
            $this->set('userForename', $userForename);
            $this->set('userSurname', $userSurname);
            $this->set('role', $role);
        }

        if ($role == 1)
            $this->redirect(\Configuration::BASE . 'admin/');
    }

    public function getRegister() {
        if ($this->getSession()->get('user_id')) {
            $this->redirect(\Configuration::BASE);
        }
    }
    public function postRegister() {
        $forename  = \filter_input(INPUT_POST, 'forename', FILTER_SANITIZE_STRING);
        $surname   = \filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
        $email     = \filter_input(INPUT_POST, 'e-mail', FILTER_SANITIZE_EMAIL);
        $password  = \filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $validanEmail = (new \App\Validators\EmailValidator())
            ->isValid($email);

        if ( !$validanEmail) {
            $this->set('message', 'Došlo je do greške: E-mail nije ispravnog formata.');
            return;
        }

        $validanPassword = (new \App\Validators\PasswordValidator())
            ->isValid($password);

        if ( !$validanPassword) {
            $this->set('message', 'Došlo je do greške: Lozinka nije ispravnog formata.');
            return;
        }

        $userModel = new \App\Models\UserModel($this->getDatabaseConnection());

        $user = $userModel->getByEmail($email);
        if ($user) {
            $this->set('message', 'Došlo je do greške: Već postoji korisnik sa tom adresom e-pošte.');
            return;
        }

        $passwordHash = \password_hash($password, PASSWORD_DEFAULT);

        $userId = $userModel->add([
            'email'         => $email,
            'first_name'    => $forename,
            'last_name'     => $surname,
            'password'      => $passwordHash,
            'user_type'     => 2
        ]);

        if (!$userId) {
            $this->set('message', 'Došlo je do greške: Nije bilo uspešno registrovanje naloga.');
            return;
        }

        $this->getSession()->put('message_successfull', 'Napravljen je novi nalog. Sada možete da se prijavite.');
        $this->getSession()->save();

        $this->redirect(\Configuration::BASE . 'user/login');
    }

    public function getLogin() {
        if ($this->getSession()->get('user_id')) {
            $this->redirect(\Configuration::BASE);
        }
        $message = $this->getSession()->get('message_successfull');
        if ($message !== null) {
            $this->set('messageSuccessfull', $message);

            $this->getSession()->remove('message_successfull');
            $this->getSession()->save();
        }
    }
    public function postLogin() {
        $email = \filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = \filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $validanEmail = (new \App\Validators\EmailValidator())
            ->isValid($email);

        if ( !$validanEmail) {
            $this->set('message', 'Došlo je do greške: E-mail nije ispravnog formata.');
            return;
        }

        $validanPassword = (new \App\Validators\StringValidator())
            ->setMinLength(7)
            ->setMaxLength(120)
            ->isValid($password);

        if ( !$validanPassword) {
            $this->set('message', 'Došlo je do greške: Lozinka nije ispravnog formata.');
            return;
        }

        $userModel = new \App\Models\UserModel($this->getDatabaseConnection());

        $user = $userModel->getByFieldName('email', $email);
        if (!$user) {
            $this->set('message', 'Došlo je do greške: Ne postoji korisnik sa tim korisničkim imenom.');
            return;
        }

        if (!password_verify($password, $user->password)) {
            sleep(1);
            $this->set('message', 'Došlo je do greške: Lozinka nije ispravna.');
            return;
        }

        $this->getSession()->put('user_id', $user->user_id);
        $this->getSession()->put('user_forename', $user->first_name);
        $this->getSession()->put('user_surname', $user->last_name);
        $this->getSession()->put('role', $user->user_type);
        $this->getSession()->save();

        if ($user->user_type == 1)
            $this->redirect(\Configuration::BASE . 'admin/');

        $this->redirect(\Configuration::BASE);
    }
    public function getLogout() {
        $this->getSession()->remove('user_id');
        $this->getSession()->remove('user_forename');
        $this->getSession()->remove('user_surname');
        $this->getSession()->remove('role');
        $this->getSession()->save();
        $this->redirect(\Configuration::BASE);
    }
}
