<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <!-- head -->
        <thead>
        <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Wallet</th>
            <th>Payment Method</th>
            <th>Notes</th>
        </tr>
        </thead>
        <tbody>
        <!-- row 1 -->
        @foreach($expenses as $index)
            <tr>
                <th>{{$index->date}}</th>
                <td>{{$index->amount}}</td>
                <td>{{$index->category}}</td>
                <td>{{$index->wallet_type}}</td>
                <td>{{$index->payment_method}}</td>
                <td>{{$index->notes}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
