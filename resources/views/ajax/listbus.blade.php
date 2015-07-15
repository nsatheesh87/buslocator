<table class="table table-hover">
      <thead>
        <tr>
          <th>Bus No</th>
          <th>Bus Name</th>
          <th>Distance</th>
        </tr>
      </thead>
      <tbody>
      @foreach($response as $buslist) 
        <tr>
          <th scope="row">{{ $buslist->busno }}</th>
          <td>{{ $buslist->name }}</td>
          <td><?php echo round($buslist->distance,2); ?> Miles away</td>
        </tr>
       @endforeach
      </tbody>
    </table>