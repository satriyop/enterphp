@extends('layouts.app')

@section('content')
<div class="container">
    <h2>PHP Code Playground</h2>    
    <div class="d-flex justify-content-between">
        <div id="editor" style="width:700px; height:613px; border:1px solid #ccc;">
            <div class="d-flex justify-content-end">
                <div id="action"></div>
            </div>
        </div>
        <br>
        <br>
        <div id="result"></div>
    </div>  
</div>
<script src="{{ asset('monaco.js') }}"></script>
<script>
    var editor; 
    document.addEventListener('DOMContentLoaded', function() {
        editor = monaco.editor.create(
            document.getElementById('editor'),
            {
                value: `<?php`,
                language: 'php',
                theme: 'vs-dark'
            }
        );
    });
</script>
<script>
    var resp;

    const divBtn = document.createElement('div');
    const btn = document.createElement('button');
    btn.innerHTML = 'Run';
    btn.className = 'btn btn-primary';
    divBtn.appendChild(btn);
    const divAction = document.getElementById('action');
    divAction.appendChild(divBtn);
    // button run executed
    btn.onclick = function(){
        const code = editor.getValue();
        console.log("running code snippet");
        console.log(editor.getValue());

        axios.post('http://enterphp.test/code', {
            code: code
        })
        .then(res => { 
            console.log(res.data);
            resp = res.data;
            textArea.value = resp.result;
        })
        .catch(e => console.log(e));

        
    }
</script>
<script>
    const divResult = document.getElementById('result');
    const textArea = document.createElement('textarea');
    // textArea.className = 'form-control';
    textArea.rows = 28;
    textArea.cols = 50;
    // textArea.readOnly =true;
    divResult.appendChild(textArea);

    // if (result !== undefined) {
    //     const output = JSON.parse(result);
    //     textArea.innerText = output.result;
    // }
    // const output = JSON.parse(result);
    
 
</script>
@endsection


@push('styles')
@endpush
@push('scripts')
@endpush