<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Limpar tabelas na ordem correta (respeitando FKs)
        $this->truncateTables();

        $now = Carbon::now();

        // =====================================================
        // 1. ROLES (15 registos)
        // =====================================================
        $roles = [
            'Administrador', 'Gestor', 'Contabilista', 'Vendedor', 'Caixa',
            'Supervisor', 'Operador', 'Auditor', 'Consultor', 'Diretor',
            'Assistente', 'Técnico', 'Analista', 'Coordenador', 'Estagiário'
        ];

        foreach ($roles as $index => $role) {
            DB::table('roles')->insert([
                'id'         => $index + 1,
                'role'       => $role,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // 2. COMPANIES (15 registos)
        // =====================================================
        $companies = [
            ['TechSolutions Lda', '500012345', 'Luanda, Rua Amílcar Cabral 45', '+244 923 100 001', 'contacto@techsolutions.ao', 'logo1.png', 'Geral', 'FT'],
            ['Comercial Angola SA', '500023456', 'Benguela, Av. Independência 12', '+244 923 100 002', 'info@comercialangola.ao', 'logo2.png', 'Simplificado', 'CA'],
            ['Serviços Premium Lda', '500034567', 'Huambo, Rua dos Combates 78', '+244 923 100 003', 'geral@servicospremium.ao', 'logo3.png', 'Geral', 'SP'],
            ['Distribuidora Norte', '500045678', 'Lubango, Av. 4 de Fevereiro 33', '+244 923 100 004', 'vendas@distribuidoranorte.ao', 'logo4.png', 'Simplificado', 'DN'],
            ['Consultoria Global', '500056789', 'Lobito, Rua da Liberdade 90', '+244 923 100 005', 'admin@consultoriaglobal.ao', 'logo5.png', 'Geral', 'CG'],
            ['AgroBusiness AO', '500067890', 'Malanje, Av. Principal 15', '+244 923 100 006', 'contacto@agrobusiness.ao', 'logo6.png', 'Simplificado', 'AB'],
            ['Construções Modernas', '500078901', 'Cabinda, Rua do Porto 22', '+244 923 100 007', 'info@construcoesmodernas.ao', 'logo7.png', 'Geral', 'CM'],
            ['Logística Express', '500089012', 'Soyo, Av. Marginal 55', '+244 923 100 008', 'ops@logisticaexpress.ao', 'logo8.png', 'Simplificado', 'LE'],
            ['Energia Solar Lda', '500090123', 'Namibe, Rua das Flores 8', '+244 923 100 009', 'solar@energiasolar.ao', 'logo9.png', 'Geral', 'ES'],
            ['Retail Market SA', '500101234', 'Uíge, Av. Central 40', '+244 923 100 010', 'loja@retailmarket.ao', 'logo10.png', 'Simplificado', 'RM'],
            ['Saúde Plus Lda', '500112345', 'Cuito, Rua da Saúde 17', '+244 923 100 011', 'clinica@saudeplus.ao', 'logo11.png', 'Geral', 'SP'],
            ['Educação Digital', '500123456', 'Ndalatando, Av. Escola 29', '+244 923 100 012', 'info@educacaodigital.ao', 'logo12.png', 'Simplificado', 'ED'],
            ['Transportes Unidos', '500134567', 'Saurimo, Terminal Rodoviário', '+244 923 100 013', 'frota@transportesunidos.ao', 'logo13.png', 'Geral', 'TU'],
            ['Finanças Seguras', '500145678', 'Menongue, Rua do Banco 3', '+244 923 100 014', 'financeiro@financasseguros.ao', 'logo14.png', 'Simplificado', 'FS'],
            ['Inovação Tech', '500156789', 'Dundo, Parque Tecnológico', '+244 923 100 015', 'dev@inovacaotech.ao', 'logo15.png', 'Geral', 'IT'],
        ];

        foreach ($companies as $index => $company) {
            DB::table('companies')->insert([
                'id'             => $index + 1,
                'name'           => $company[0],
                'nif'            => $company[1],
                'address'        => $company[2],
                'phone'          => $company[3],
                'email'          => $company[4],
                'logo'           => $company[5],
                'tax_regime'     => $company[6],
                'invoice_prefix' => $company[7],
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }

        // =====================================================
        // 3. USERS (15 registos)
        // =====================================================
        $users = [
            ['Admin Sistema', 'admin@softfacturacao.ao'],
            ['João Manuel', 'joao.manuel@techsolutions.ao'],
            ['Maria Fernandes', 'maria.fernandes@comercialangola.ao'],
            ['Carlos Silva', 'carlos.silva@servicospremium.ao'],
            ['Ana Costa', 'ana.costa@distribuidoranorte.ao'],
            ['Pedro Santos', 'pedro.santos@consultoriaglobal.ao'],
            ['Sofia Mendes', 'sofia.mendes@agrobusiness.ao'],
            ['Ricardo Alves', 'ricardo.alves@construcoesmodernas.ao'],
            ['Luísa Pereira', 'luisa.pereira@logisticaexpress.ao'],
            ['Miguel Rocha', 'miguel.rocha@energiasolar.ao'],
            ['Beatriz Lima', 'beatriz.lima@retailmarket.ao'],
            ['André Nunes', 'andre.nunes@saudeplus.ao'],
            ['Catarina Dias', 'catarina.dias@educacaodigital.ao'],
            ['Tiago Martins', 'tiago.martins@transportesunidos.ao'],
            ['Helena Correia', 'helena.correia@financasseguros.ao'],
        ];

        foreach ($users as $index => $user) {
            DB::table('users')->insert([
                'id'                => $index + 1,
                'name'              => $user[0],
                'email'             => $user[1],
                'email_verified_at' => $now,
                'password'          => Hash::make('password123'),
                'remember_token'    => Str::random(10),
                'role_id'           => ($index % 15) + 1,
                'company_id'        => ($index % 15) + 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }

        // =====================================================
        // 4. CATEGORIES (15 registos)
        // =====================================================
        $categories = [
            'Eletrónicos', 'Informática', 'Mobiliário', 'Vestuário', 'Alimentação',
            'Bebidas', 'Cosméticos', 'Ferramentas', 'Construção', 'Automóvel',
            'Serviços', 'Consultoria', 'Saúde', 'Educação', 'Transporte'
        ];

        foreach ($categories as $index => $category) {
            DB::table('categories')->insert([
                'id'         => $index + 1,
                'category'   => $category,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // 5. PRODUCTS (15 registos)
        // =====================================================
        $products = [
            ['Computador Portátil HP 15', 1, 1, 450000.00, 14, 'un'],
            ['Monitor LG 27"', 1, 1, 125000.00, 14, 'un'],
            ['Cadeira de Escritório Ergonómica', 3, 2, 85000.00, 14, 'un'],
            ['Camisa Social Masculina', 4, 3, 15000.00, 14, 'un'],
            ['Arroz 25kg', 5, 4, 18000.00, 0, 'saco'],
            ['Água Mineral 1.5L (cx 12)', 6, 5, 3500.00, 0, 'cx'],
            ['Creme Hidratante Facial', 7, 6, 8500.00, 14, 'un'],
            ['Furadeira Elétrica Bosch', 8, 7, 65000.00, 14, 'un'],
            ['Cimento 50kg', 9, 8, 7500.00, 14, 'saco'],
            ['Óleo de Motor 5W30', 10, 9, 12000.00, 14, 'L'],
            ['Consultoria Contabilística (hora)', 12, 10, 25000.00, 14, 'h'],
            ['Consulta Médica Geral', 13, 11, 15000.00, 0, 'un'],
            ['Curso Online de Excel', 14, 12, 35000.00, 14, 'un'],
            ['Serviço de Transporte Local', 15, 13, 8000.00, 14, 'viagem'],
            ['Impressora Multifunções Epson', 2, 14, 95000.00, 14, 'un'],
        ];

        foreach ($products as $index => $product) {
            DB::table('products')->insert([
                'id'          => $index + 1,
                'description' => $product[0],
                'category_id' => $product[1],
                'company_id'  => $product[2],
                'unit_price'  => $product[3],
                'tax_rate'    => $product[4],
                'unit'        => $product[5],
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }

        // =====================================================
        // 6. CLIENTS (15 registos)
        // =====================================================
        $clients = [
            ['Empresa Alpha Lda', '600011122', 'Luanda, Talatona', '+244 912 000 001', 1],
            ['Beta Comércio SA', '600022233', 'Benguela Centro', '+244 912 000 002', 2],
            ['Gamma Serviços', '600033344', 'Huambo, Cidade Alta', '+244 912 000 003', 3],
            ['Delta Distribuição', '600044455', 'Lubango, Centro', '+244 912 000 004', 4],
            ['Epsilon Consulting', '600055566', 'Lobito, Restinga', '+244 912 000 005', 5],
            ['Zeta Agro', '600066677', 'Malanje, Bairro Novo', '+244 912 000 006', 6],
            ['Eta Construções', '600077788', 'Cabinda, Chiloango', '+244 912 000 007', 7],
            ['Theta Logistics', '600088899', 'Soyo, Porto', '+244 912 000 008', 8],
            ['Iota Energia', '600099900', 'Namibe, Centro', '+244 912 000 009', 9],
            ['Kappa Retail', '600100011', 'Uíge, Mercado', '+244 912 000 010', 10],
            ['Lambda Saúde', '600111122', 'Cuito, Hospital', '+244 912 000 011', 11],
            ['Mu Educação', '600122233', 'Ndalatando, Escola', '+244 912 000 012', 12],
            ['Nu Transportes', '600133344', 'Saurimo, Terminal', '+244 912 000 013', 13],
            ['Xi Finanças', '600144455', 'Menongue, Banco', '+244 912 000 014', 14],
            ['Omicron Tech', '600155566', 'Dundo, Parque', '+244 912 000 015', 15],
        ];

        foreach ($clients as $index => $client) {
            DB::table('clients')->insert([
                'id'         => $index + 1,
                'name'       => $client[0],
                'nif'        => $client[1],
                'address'    => $client[2],
                'phone'      => $client[3],
                'company_id' => $client[4],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // 7. INVOICE_ITEMS (15 registos)
        // =====================================================
        for ($i = 1; $i <= 15; $i++) {
            DB::table('invoice_items')->insert([
                'id'         => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // 8. INVOICES (15 registos)
        // =====================================================
        for ($i = 1; $i <= 15; $i++) {
            DB::table('invoices')->insert([
                'id'               => $i,
                'invoice_item_id'  => $i,
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);
        }

        // =====================================================
        // 9. PAYMENTS (15 registos)
        // =====================================================
        for ($i = 1; $i <= 15; $i++) {
            DB::table('payments')->insert([
                'id'         => $i,
                'invoice_id' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // =====================================================
        // 10. PERMITIONS (15 registos)
        // =====================================================
        for ($i = 1; $i <= 15; $i++) {
            DB::table('permitions')->insert([
                'id'         => $i,
                'role_id'    => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Seeder executado com sucesso!');
        $this->command->info('Tabelas preenchidas com 15 registos cada.');
    }

    private function truncateTables(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tables = [
            'payments',
            'invoices',
            'invoice_items',
            'permitions',
            'clients',
            'products',
            'categories',
            'users',
            'companies',
            'roles',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}