import Mermaid from 'mermaid';


 function test()
{
    alert("hello world");
}


// test();

Mermaid.initialize({
    startOnLoad:true ,
    securityLevel:'loose',
    // logLevel: '1',
    flowchart:{
        useMaxWidth:false,
    }});



 function clicked( el )
 {


    console.log( el.closest('.node, .default') )

 }


window.addEventListener('load', function(){

    document.querySelectorAll('.node, .default ').forEach( function( el ){
        el.addEventListener('click', function(f){
            console.log( f.target.closest(".node, .default").id.split('-')[1] );

            Livewire.emit("pickQuestion", f.target.closest(".node, .default").id.split('-')[1] )
        })
    })



    // let gs = document.querySelectorAll('g');
    //
    // console.log( gs.length );
    //
    // gs.forEach(function(g){
    //     g.addEventListener('click', (f) => clicked(f.target ) );
    //
    // })


})
