<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;  

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $categories = [  
                'Matemática',  
                'Física',  
                'Tecnologia da Informação (TI)',  
                'Programação',  
                'Redes de Computadores',  
                'Análise/Ciência de Dados',  
                'Desenvolvimento Pessoal',  
                'Inglês',  
                'Inteligência Artificial',  
                'Desenvolvimento Web e Mobile',  
                'Filosofia',  
                'Religião',  
                'Artes',  
                'Infantil',        
                'Poesia',  
                'Esportes',  
                'Saúde e bem-estar',  
            ];  

            foreach ($categories as $categoryName) {  
                Category::create(['name' => $categoryName]);  
            }  
        
    }
}
