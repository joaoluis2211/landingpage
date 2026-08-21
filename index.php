<?php
// Processamento do Formulário de Agendamento
$mensagem_sucesso = '';
$mensagem_erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização e Validação dos Dados
    $nome    = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $fone    = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($nome && $email && $fone && $servico) {
        $mensagem_sucesso = "🪓 Recebido com sucesso, $nome! Entraremos em contato via WhatsApp em breve para confirmar seu horário e reservar seu Chopp Cortesia!";
    } else {
        $mensagem_erro = "Por favor, preencha todos os campos corretamente para concluir o agendamento.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vikings Barber | Estilo Guerreiro & Cerveja Gelada</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-neutral-950 text-neutral-100 font-sans antialiased selection:bg-amber-500 selection:text-neutral-950">

    <!-- Header / Barra Superior -->
    <header class="py-5 border-b border-neutral-800 bg-neutral-950/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-black tracking-wider text-amber-500 uppercase">Vikings Barber</span>
            </div>
            <a href="#agendamento" class="bg-amber-500 hover:bg-amber-400 text-neutral-950 font-bold px-5 py-2.5 rounded-lg text-sm transition-all transform hover:scale-105 shadow-md hover:shadow-amber-500/20">
                Agendar Horário
            </a>
        </div>
    </header>

    <!-- 1. HERO SECTION -->
    <section class="py-16 md:py-24 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-neutral-900 via-neutral-950 to-neutral-950">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Headline & Proposta de Valor -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                    <span>🍻 Primeiro Agendamento Ganha 1 Chopp Artesanal</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black tracking-tight text-white leading-tight uppercase">
                    Mais que um corte. Um <span class="text-amber-500 underline decoration-amber-500/30">ritual de honra</span>.
                </h1>
                <p class="text-lg text-neutral-400 leading-relaxed">
                    Alinhe sua barba, garanta o corte perfeito na régua e viva uma experiência completa com toalha quente, cerveja artesanal e atendimento sem filas.
                </p>
                
                <div class="pt-2 grid grid-cols-2 md:grid-cols-3 gap-4 text-sm font-semibold text-neutral-300">
                    <div class="flex items-center gap-2">
                        <span class="text-amber-500 font-bold">✓</span> Toalha Quente
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-amber-500 font-bold">✓</span> Chopp ou Café
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-amber-500 font-bold">✓</span> Estacionamento
                    </div>
                </div>

                <!-- IMAGEM HERO (1- hero) -->
                <div class="mt-6 rounded-xl overflow-hidden border border-neutral-800 shadow-2xl h-[220px]">
                    <img src="assets/hero.png" alt="Vikings Barber Ambiente" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <!-- Formulário de Agendamento -->
            <div id="agendamento" class="lg:col-span-5 bg-neutral-900 border border-neutral-800 p-8 rounded-2xl shadow-2xl relative">
                <h2 class="text-2xl font-black text-white uppercase tracking-wide">Agende seu Horário</h2>
                <p class="text-neutral-400 text-sm mb-6">Garante 10% de desconto + 1 Chopp Cortesia no primeiro atendimento.</p>

                <?php if (!empty($mensagem_sucesso)): ?>
                    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-lg mb-6 text-sm">
                        <?= $mensagem_sucesso ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($mensagem_erro)): ?>
                    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-4 rounded-lg mb-6 text-sm">
                        <?= $mensagem_erro ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
                    <div>
                        <label for="nome" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider mb-1">Seu Nome</label>
                        <input type="text" id="nome" name="nome" required placeholder="Ex: Bjorn Lothbrok" 
                            class="w-full bg-neutral-950 border border-neutral-800 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-white rounded-lg px-4 py-3 outline-none transition-colors">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider mb-1">E-mail</label>
                        <input type="email" id="email" name="email" required placeholder="seuemail@exemplo.com" 
                            class="w-full bg-neutral-950 border border-neutral-800 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-white rounded-lg px-4 py-3 outline-none transition-colors">
                    </div>

                    <div>
                        <label for="telefone" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider mb-1">WhatsApp</label>
                        <input type="tel" id="telefone" name="telefone" required placeholder="(00) 99999-9999" 
                            class="w-full bg-neutral-950 border border-neutral-800 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-white rounded-lg px-4 py-3 outline-none transition-colors">
                    </div>

                    <div>
                        <label for="servico" class="block text-xs font-bold text-neutral-300 uppercase tracking-wider mb-1">Serviço Desejado</label>
                        <select id="servico" name="servico" required 
                            class="w-full bg-neutral-950 border border-neutral-800 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-white rounded-lg px-4 py-3 outline-none transition-colors">
                            <option value="" disabled selected>Selecione um serviço</option>
                            <option value="Cabelo">Corte Viking (Cabelo)</option>
                            <option value="Barba">Barboterapia Completa</option>
                            <option value="Combo">Combo Ragnarr (Cabelo + Barba)</option>
                        </select>
                    </div>

                    <button type="submit" 
                        class="w-full bg-amber-500 hover:bg-amber-400 text-neutral-950 font-black py-4 px-6 rounded-lg uppercase tracking-wider shadow-lg hover:shadow-amber-500/20 transition-all transform active:scale-95">
                        GARANTIR MINHA VAGA
                    </button>

                    <p class="text-xs text-center text-neutral-500 mt-2">
                        🔒 Sem filas. Escolha o melhor dia e horário via WhatsApp.
                    </p>
                </form>
            </div>

        </div>
    </section>

    <!-- 2. PROVA SOCIAL -->
    <section class="py-8 border-y border-neutral-800 bg-neutral-900/80">
        <div class="max-w-6xl mx-auto px-4 flex flex-wrap justify-around items-center gap-6 text-center">
            <div>
                <p class="text-3xl font-black text-amber-500">+5.000</p>
                <p class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Cortes Realizados</p>
            </div>
            <div class="h-8 w-px bg-neutral-800 hidden md:block"></div>
            <div>
                <p class="text-3xl font-black text-amber-500">4.9 ★</p>
                <p class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Avaliação Google (300+ reviews)</p>
            </div>
            <div class="h-8 w-px bg-neutral-800 hidden md:block"></div>
            <div>
                <p class="text-3xl font-black text-amber-500">100%</p>
                <p class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Chopp Gelado Garantido</p>
            </div>
        </div>
    </section>

    <!-- 3. PAS / BENEFÍCIOS -->
    <section class="py-20 bg-neutral-950">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-amber-500 text-xs font-bold uppercase tracking-widest">Cansaço de barbearia comum?</span>
                <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-wider mt-2">A Experiência que Você Merece</h2>
                <p class="text-neutral-400 mt-3">Esqueça filas de espera intermináveis, cortes apressados e conversa fiada. Na Vikings nós cuidamos do seu visual com precisão.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Item 1 (2- pub) -->
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden hover:border-amber-500/50 transition-colors">
                    <div class="h-[200px] overflow-hidden">
                        <img src="assets/pub.png" alt="Pub e Lounge Exclusivo" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Pub & Lounge Exclusivo</h3>
                        <p class="text-neutral-400 text-sm leading-relaxed">Chegue antes do horário e relaxe. Temos bancada com chopp artesanal gelado, sinuca e área lounge confortável.</p>
                    </div>
                </div>

                <!-- Item 2 (3- barba) -->
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden hover:border-amber-500/50 transition-colors">
                    <div class="h-[200px] overflow-hidden">
                        <img src="assets/barba.png" alt="Barboterapia com Toalha Quente" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Barboterapia com Toalha Quente</h3>
                        <p class="text-neutral-400 text-sm leading-relaxed">Tratamento completo com produtos de primeira linha, óleos essenciais, massagem facial e navalha afiada no detalhe.</p>
                    </div>
                </div>

                <!-- Item 3 (4- corte) -->
                <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden hover:border-amber-500/50 transition-colors">
                    <div class="h-[200px] overflow-hidden">
                        <img src="assets/corte.png" alt="Visagismo e Precisão no Corte" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">Visagismo & Precisão</h3>
                        <p class="text-neutral-400 text-sm leading-relaxed">Nossos barbeiros analisam o formato do seu rosto e estilo pessoal para indicar o melhor tipo de corte e barba.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SERVIÇOS & OFERTA -->
    <section class="py-20 border-t border-neutral-800 bg-neutral-900/40">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-amber-500 text-xs font-bold uppercase tracking-widest">Tabela Transparente</span>
                <h2 class="text-3xl font-black text-white uppercase tracking-wider mt-1">Nossos Serviços & Combos</h2>
                <p class="text-neutral-400 text-sm mt-1">Escolha o serviço ideal para o seu momento.</p>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center p-6 bg-neutral-900 rounded-xl border border-neutral-800">
                    <div>
                        <h3 class="text-xl font-bold text-white">Corte Viking (Cabelo)</h3>
                        <p class="text-sm text-neutral-400">Corte moderno ou clássico + lavagem especial + finalização.</p>
                    </div>
                    <span class="text-2xl font-black text-amber-500">R$ 55</span>
                </div>

                <div class="flex justify-between items-center p-6 bg-neutral-900 rounded-xl border border-neutral-800">
                    <div>
                        <h3 class="text-xl font-bold text-white">Barboterapia Tradicional</h3>
                        <p class="text-sm text-neutral-400">Modelagem de barba com toalha quente e óleos hidratantes.</p>
                    </div>
                    <span class="text-2xl font-black text-amber-500">R$ 45</span>
                </div>

                <div class="flex justify-between items-center p-6 bg-neutral-900/90 rounded-xl border-2 border-amber-500 relative overflow-hidden shadow-xl">
                    <span class="absolute top-0 right-0 bg-amber-500 text-neutral-950 text-[10px] font-black uppercase px-3 py-1 rounded-bl-lg">Mais Escolhido</span>
                    <div>
                        <h3 class="text-xl font-bold text-white">Combo Ragnarr (Cabelo + Barba)</h3>
                        <p class="text-sm text-neutral-400">Corte completo + Barboterapia + 1 Chopp artesanal cortesia.</p>
                    </div>
                    <span class="text-2xl font-black text-amber-500">R$ 85</span>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#agendamento" class="inline-block bg-amber-500 hover:bg-amber-400 text-neutral-950 font-black px-8 py-4 rounded-lg uppercase tracking-wider text-sm transition-all shadow-lg hover:shadow-amber-500/20">
                    QUERO AGENDAR ESSE COMBO
                </a>
            </div>
        </div>
    </section>

    <!-- 5. GALERIA & DEPOIMENTOS -->
    <section class="py-20 border-t border-neutral-800 bg-neutral-950">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-amber-500 text-xs font-bold uppercase tracking-widest">Galeria & Avaliações</span>
                <h2 class="text-3xl font-black text-white uppercase tracking-wider mt-1">O Que Nossos Clientes Dizem</h2>
            </div>

            <!-- Grid de Fotos de Resultados (5- 1 - foto1 e variações) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                <div class="rounded-lg overflow-hidden border border-neutral-800 aspect-square">
                    <img src="assets/foto1.png" alt="Resultado Corte e Barba 1" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-lg overflow-hidden border border-neutral-800 aspect-square">
                    <img src="assets/foto2.png" alt="Resultado Corte e Barba 2" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-lg overflow-hidden border border-neutral-800 aspect-square">
                    <img src="assets/foto3.png" alt="Resultado Corte e Barba 3" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-lg overflow-hidden border border-neutral-800 aspect-square">
                    <img src="assets/foto4.png" alt="Resultado Corte e Barba 4" class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <!-- Depoimentos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-neutral-900 rounded-xl border border-neutral-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div>
                            <h4 class="text-white font-bold text-sm">Carlos Eduardo</h4>
                            <span class="text-amber-500 text-xs">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-neutral-300 text-sm">"Atendimento sensacional! A toalha quente na barba é relaxante demais. O chopp gelado na chegada faz toda a diferença no fim do dia de trabalho."</p>
                </div>

                <div class="p-6 bg-neutral-900 rounded-xl border border-neutral-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div>
                            <h4 class="text-white font-bold text-sm">Lucas Andrade</h4>
                            <span class="text-amber-500 text-xs">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-neutral-300 text-sm">"Corte impecável. Fazia tempo que não achava uma barbearia com barbeiros tão detalhistas quanto o pessoal da Vikings. Vale cada centavo."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-16 border-t border-neutral-800 bg-neutral-900/40">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-black text-white uppercase tracking-wider">Dúvidas Frequentes</h2>
            </div>

            <div class="space-y-4 text-sm">
                <div class="p-5 bg-neutral-900 rounded-lg border border-neutral-800">
                    <h3 class="font-bold text-white mb-1">Preciso agendar com antecedência?</h3>
                    <p class="text-neutral-400">Recomendamos o agendamento prévio pelo formulário ou WhatsApp para garantir o seu horário sem espera.</p>
                </div>
                <div class="p-5 bg-neutral-900 rounded-lg border border-neutral-800">
                    <h3 class="font-bold text-white mb-1">Como funciona o Chopp Cortesia?</h3>
                    <p class="text-neutral-400">Todos os novos clientes que realizarem o agendamento pelo formulário desta página ganham 1 copo de Chopp Artesanal na chegada.</p>
                </div>
                <div class="p-5 bg-neutral-900 rounded-lg border border-neutral-800">
                    <h3 class="font-bold text-white mb-1">Quais as formas de pagamento?</h3>
                    <p class="text-neutral-400">Aceitamos Pix, cartões de crédito/débito e dinheiro.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="py-16 bg-gradient-to-t from-amber-600/20 to-neutral-950 text-center border-t border-neutral-800">
        <div class="max-w-3xl mx-auto px-4 space-y-6">
            <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-wider">Pronto para dar o upgrade no seu estilo?</h2>
            <p class="text-neutral-300">Garanta seu horário agora mesmo e ganhe seu Chopp Cortesia na entrada.</p>
            <a href="#agendamento" class="inline-block bg-amber-500 hover:bg-amber-400 text-neutral-950 font-black px-10 py-5 rounded-lg uppercase tracking-wider text-base transition-all transform hover:scale-105 shadow-2xl">
                AGENDAR MEU HORÁRIO AGORA
            </a>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="py-8 border-t border-neutral-800 bg-neutral-950 text-center text-neutral-500 text-xs">
        <p>© <?= date('Y'); ?> Vikings Barber. Todos os direitos reservados. Rua dos Guerreiros, 100 - Centro.</p>
    </footer>

</body>
</html>