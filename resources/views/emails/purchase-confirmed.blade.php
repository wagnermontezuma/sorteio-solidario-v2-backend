@php($customer = $purchase->customer)
@php($raffle = $purchase->raffle)
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação da sua participação</title>
</head>
<body>
    <p>Olá {{ $customer->name }},</p>

    <p>Recebemos a confirmação do seu pagamento no sorteio <strong>{{ $raffle->name }}</strong>.</p>

    <p>Seus números da sorte são:</p>
    <ul>
        @foreach ($ticketNumbers as $number)
            <li><strong>{{ $number }}</strong></li>
        @endforeach
    </ul>

    <p>Guarde estes números com carinho. Eles serão utilizados na apuração vinculada à Loteria Federal.</p>

    @if ($raffle->federal_lottery_contest)
        <p><strong>Concurso da Loteria Federal:</strong> {{ $raffle->federal_lottery_contest }}</p>
    @endif

    @if ($raffle->draw_date)
        <p><strong>Data prevista do sorteio:</strong> {{ $raffle->draw_date->format('d/m/Y H:i') }}</p>
    @endif

    <p>Desejamos boa sorte!</p>
    <p>Equipe Sorteio Solidário</p>
</body>
</html>
