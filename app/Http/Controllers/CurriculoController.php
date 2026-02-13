<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculoController extends Controller
{
    public function index()
    {
        $dados = [
            'nome' => 'Moab Lima Silva',
            'cargo' => 'Engenheiro de Computação | Dev Full Stack & Game Developer',
            'resumo' => 'Estudante de Engenharia da Computação na UNIFAN. Desenvolvedor com foco em Web (Laravel), Banco de Dados e criação de Jogos (Godot). Atualmente pesquisando Visão Computacional e IA aplicada à tradução de Libras.',
            'contato' => [
                'email' => 'moablima2016@gmail.com',
                'linkedin' => 'linkedin.com/in/M0abl1',
                'github' => 'github.com/M0abl1',
            ],
            'skills' => [
                'Backend & DevOps' => [
                    ['name' => 'PHP 8+', 'icon' => 'devicon-php-plain colored'],
                    ['name' => 'Laravel', 'icon' => 'devicon-laravel-original colored'],
                    ['name' => 'MySQL', 'icon' => 'devicon-mysql-plain colored'],
                    ['name' => 'Docker', 'icon' => 'devicon-docker-plain colored'],
                    ['name' => 'Java', 'icon' => 'devicon-java-plain colored'],
                    ['name' => 'Postman', 'icon' => 'devicon-postman-plain colored'],
                    ['name' => 'PHPUnit', 'icon' => 'devicon-php-plain text-purple-600'], 
                    ['name' => 'API REST', 'icon' => 'fas fa-server text-gray-500'], // Ícone genérico
                ],
                
                'IA & Data Science' => [
                    ['name' => 'Python', 'icon' => 'devicon-python-plain colored'],
                    ['name' => 'OpenCV', 'icon' => 'devicon-opencv-plain colored'],
                    ['name' => 'NumPy', 'icon' => 'devicon-numpy-plain colored'],
                    ['name' => 'Pandas', 'icon' => 'devicon-pandas-plain colored'],
                    ['name' => 'Matplotlib', 'icon' => 'devicon-matplotlib-plain colored'],
                    ['name' => 'Jupyter', 'icon' => 'devicon-jupyter-plain colored'],
                    ['name' => 'MediaPipe', 'icon' => 'fas fa-hand-paper text-blue-400'], // Genérico
                    ['name' => 'Machine Learning', 'icon' => 'fas fa-brain text-pink-500'], // Genérico
                ],

                'Game Dev & Design' => [
                    ['name' => 'Godot Engine', 'icon' => 'devicon-godot-plain colored'],
                    ['name' => 'GDScript', 'icon' => 'fas fa-scroll text-green-500'], // Genérico
                    ['name' => 'Blender', 'icon' => 'devicon-blender-original colored'],
                    ['name' => 'Lógica de Jogos', 'icon' => 'fas fa-chess-knight text-purple-500'],
                ],

                'Frontend & Web' => [
                    ['name' => 'HTML5', 'icon' => 'devicon-html5-plain colored'],
                    ['name' => 'CSS3', 'icon' => 'devicon-css3-plain colored'],
                    ['name' => 'JavaScript', 'icon' => 'devicon-javascript-plain colored'],
                    ['name' => 'Tailwind CSS', 'icon' => 'devicon-tailwindcss-original colored'],
                    ['name' => 'Blade', 'icon' => 'devicon-laravel-plain text-red-500'],
                ],
                
                'Ferramentas & Ágil' => [
                    ['name' => 'Git', 'icon' => 'devicon-git-plain colored'],
                    ['name' => 'GitHub', 'icon' => 'devicon-github-original dark:text-white'],
                    ['name' => 'VS Code', 'icon' => 'devicon-vscode-plain colored'],
                    ['name' => 'Linux', 'icon' => 'devicon-linux-plain colored'],
                    ['name' => 'Scrum', 'icon' => 'fas fa-tasks text-blue-400'],
                    ['name' => 'Inglês Técnico', 'icon' => 'fas fa-language text-green-500'],
                ]
            ],
            'educacao' => [
                [
                    'curso' => 'Engenharia da Computação',
                    'instituicao' => 'UNIFAN',
                    'periodo' => '2022 - 2025'
                ]
            ]
        ];

        return view('curriculo', compact('dados'));
    }
}