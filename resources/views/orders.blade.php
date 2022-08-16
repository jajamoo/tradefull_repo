<table class="table">
    <thead>
    <tr>
        <th scope="col"> User ID </th>
        <th scope="col"> First Name </th>
        <th scope="col"> Last name </th>
        <th scope="col"> Address 1 </th>
        <th scope="col"> Address 2 </th>
        <th scope="col"> City </th>
        <th scope="col"> State </th>
        <th scope="col"> Postal Code </th>
        <th scope="col"> Country </th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <th scope="row">{{ $order->user_id }}</th>
            <td> {{$order->first_name}} </td>
            <td> {{$order->last_name}} </td>
            <td> {{$order->address_1}} </td>
            <td> {{$order->address_2}} </td>
            <td> {{$order->city}} </td>
            <td> {{$order->state}} </td>
            <td> {{$order->postal_code}} </td>
            <td> {{$order->country}} </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ url('/') }}">
    <i class="icon-dashboard"></i>
    <span class="menu-text"> Go Back </span>
</a>
