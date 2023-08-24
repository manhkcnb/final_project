<div class="product-options">
                        @php
                            $product_if=app(App\Http\Controllers\Frontend\IndexController)->getProductIf($row->id);
                            $printedSizes = [];
                            $printColor = [];
                        @endphp
                        <strong>SIZES</strong>
                        <div style="display:flex;"> 
                        @foreach($product_if as $key)
                        @php
                            $sizes = app(App\Http\Controllers\Frontend\indexControlle)->getSizeById($key->size_id);
                        @endphp
                        @if (!in_array($sizes->name, $printedSizes))
                            <div style="margin-right: 2px">{{$sizes->name}} </div>
                            @php
                                $printedSizes[] = $sizes->name;
                            @endphp
                        @endif
                        @endforeach
                        </div>
                        <strong>COLORS</strong>
                        
                        <div class="colors">
                            @foreach($product_if as $key)
                            @php
                                 $colors = app(App\Http\Controllers\Frontend\indexControlle)->getColorById($key->color_id);
                            @endphp
                            @if(!in_array($colors->code,$printColor))
                                <div style="background:{{$colors->code}};border: 0.1px solid grey;"><span></span></div>
                                @php
                                    $printColor[] = $colors->code;
                                @endphp
                            @endif
                            @endforeach
                            
                        </div>
                    </div>









