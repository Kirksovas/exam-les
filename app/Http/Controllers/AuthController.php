<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Метод для отображения страницы регистрации
    public function signup()
    {
        return view('auth.signup'); // Страница регистрации
    }

    // Метод для обработки регистрации
    public function registr(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Указан правильный столбец в таблице
            'password' => 'required|min:6|confirmed', // Подтверждение пароля
        ]);

        // Роль по умолчанию будет 'user', если существует администратор
        $role = User::where('role', 'admin')->exists() ? 'user' : 'admin'; // Если администратор уже есть, создаем обычного пользователя

        // Создание нового пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // Присваиваем роль
        ]);

        // После успешной регистрации, перенаправляем на страницу входа
        return redirect()->route('login')->with('success', 'Registration successful!'); // Сообщение об успешной регистрации
    }

    // Метод для отображения страницы логина
    public function login()
    {
        return view('auth.login'); // Страница логина
    }

    // Метод для авторизации
    public function authenticate(Request $request)
{
    // Валидация данных для входа
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Проверка учетных данных пользователя
    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate(); // Обновление сессии

        // Перенаправление в зависимости от роли пользователя
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Роль администратора
        } elseif (Auth::user()->role === 'moderator') {
            return redirect()->route('moderator.panel'); // Роль модератора
        }

        // Перенаправление на корень сайта
        return redirect('/'); // Вместо '/home' используем '/'
    }

    // Ошибка при неверных данных для входа
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    // Метод для выхода из системы
    public function logout(Request $request)
    {
        Auth::logout(); // Выход из системы
        $request->session()->invalidate(); // Инвалидируем сессию
        $request->session()->regenerateToken(); // Регенерация CSRF токена
        return redirect('/'); // Перенаправляем на главную страницу
    }
}
