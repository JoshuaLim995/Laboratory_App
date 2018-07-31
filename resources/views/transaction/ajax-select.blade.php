@if(!empty($itemLocation))
  @foreach($itemLocation as $key => $value)
    <option value="{{ $key }}">{{ $value }}</option>
  @endforeach
@endif