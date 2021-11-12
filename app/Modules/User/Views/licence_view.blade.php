@include('header')
<table class="table table-striped table-hover">
                <thead>
                    <tr>
                        
                        
                        <th scope="col">previous licence</th>
                        <th scope="col">current licence</th>
                        <th scope="col">name</th>
                        <th scope="col">current date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $value)
                    <tr>
                        <td>{{$value->previous_licence}}</td>
                        <td>{{$value->current_licence}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->current_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('footer')