(function ($){
    var table = {
        viewsName: ['editTeacher','editAdmins','editGroup'],
        roles:['teacher','admin'],
        arrayForParent:[],
        arrayForChild:[],
        group:[],
        settingTeacherForAdmin:{
            title:[
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { 
                    "visible": false,
                    data:'id',
                },
                { 
                    "class":          "click",
                    title: "Фамилия" ,
                    data:'secondname',
                },
                { 
                    title: "Имя" ,
                    "class":          "click",
                    data:'name',
                },
                { 
                    title: "Отчество" ,
                    "class":          "click",
                    data:'thirdname',
                },                
                { 
                    title: "Статус" ,
                    "class":          "click",
                    data:'activate',
                }, 
                { 
                    title: "Роль" ,
                    "class":          "click",
                    data:'role',
                }       
            ],
            buttons:[
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        ///
                        if (!$('.childtr').closest('tr').hasClass("select")){
                            dt = $('#example').DataTable();
                            var arr=[];
                            data = dt.rows( '.select' ).data();
                            console.log(data)
                            if ($(node).hasClass('fa fa-check')){
                                $(node).removeClass('fa fa-check')
                                $(node).addClass('fa fa-pencil')
                                $(node).css('background','');
                                
                                inc=0
                                for ( i=0;i<table.arrayForParent.length;i++) {
                                    table.arrayForParent[i].secondname=$('.customedit:eq('+inc+')').find('input').val();
                                    inc+=1;
                                    table.arrayForParent[i].name=$('.customedit:eq('+inc+')').find('input').val();
                                    inc+=1;
                                    table.arrayForParent[i].thirdname=$('.customedit:eq('+inc+')').find('input').val();  
                                    inc+=1;                              
                                    table.arrayForParent[i].activate=$('.customedit:eq('+inc+')').find('select').val();  
                                    inc+=1;
                                    table.arrayForParent[i].number_group=$('.customedit:eq('+inc+')').find('select').val();  
                                    inc+=1;
                                }
                                data = JSON.stringify(table.arrayForParent);
                                console.log(data)
                                table.ajaxEdit(table.viewsName[0],data)
                            }else{
                                $(node).removeClass('fa fa-pencil')
                                $(node).addClass('fa fa-check')
                                $(node).css('background','lightgreen');                               
                                td=$('.customedit');
                                inc=0;
                                for ( i=0;i<data.length;i++) {
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+data[i].secondname+'" />');
                                    
                                    inc+=1;
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+data[i].name+'" />');
                                    
                                    inc+=1;
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+data[i].thirdname+'" />');
                                    
                                    inc+=1; 
                                    $('.customedit:eq('+inc+')').html('<select class="form-control" id="activate"></select>');
                                    if (data[i].activate=='Активирован'){
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Активирован</option>');
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Не активирован</option>');
                                    }else{
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Не активирован</option>');
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Активирован</option>');
                                    }
                                    
                                    inc+=1;
                                    $('.customedit:eq('+inc+')').html('<select class="form-control" class="group"></select>');
                                    $('.customedit:eq('+inc+')').find('select').append('<option>'+table.roles[0]+'</option>');
                                    $('.customedit:eq('+inc+')').find('select').append('<option>'+table.roles[1]+'</option>');
                                    inc+=1;
                                    table.arrayForParent.push({id:data[i].id,secondname:data[i].secondname,name:data[i].name,thirdname:data[i].thirdname,activate:data[i].activate,role:data[i].role})
                                    console.log(table.arrayForParent);
                                }

                            }
                        }else{ ///Child
                            if ($(node).hasClass('fa fa-check')){
                                $(node).removeClass('fa fa-check')
                                $(node).addClass('fa fa-pencil')
                                $(node).css('background','');
                                inc=0;
                                for ( i=0;i<table.arrayForChild.length;i++) {
                                    inc+=1;
                                    table.arrayForChild[i].discipline=$('.customedit:eq('+inc+')').find('input').val();
                                    inc+=1;
                                }
                                data = JSON.stringify(table.arrayForChild);
                                console.log(data);
                                table.ajaxEditChild(table.viewsName[0],data);
                            }else{
                                $(node).removeClass('fa fa-pencil')
                                $(node).addClass('fa fa-check')
                                $(node).css('background','lightgreen');
                                row=$('.childtr.select');
                                td=$('.customedit');
                                inc=0
                                table.arrayForChild=[];

                                for ( i=0;i<row.length;i++) {
                                    id = $('.table-cell-edit:eq('+inc+')').text();

                                    inc+=1;
                                    discipline = $('.customedit:eq('+inc+')').text();
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+discipline +'" />');
                                    inc+=1;
                                    table.arrayForChild.push({id:id,discipline:discipline})
                                    console.log(table.arrayForChild)
                                }                               
                            }
                        }
                    },
                    className: 'fa fa-pencil '
                },
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        alert( 'Button activated' );
                    },
                    className: 'fa fa-times '
                },
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        alert( 'Button activated' );
                    },
                    className: 'fa fa-exchange '
                }
            ],
        },
        settingGroupForAdmin:{
            title:[
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": "",
                },
                {
                    "visible": false,
                    data:'id',
                },
                {   
                    "class":          "click",
                    title: "Группы",
                    data:'number_group',
                }      
            ],
            buttons:[
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        if (!$('.childtr').closest('tr').hasClass("select")){
                            dt = $('#example').DataTable();
                            var arr=[];
                            data = dt.rows( '.select' ).data();
                            if ($(node).hasClass('fa fa-check')){
                                $(node).removeClass('fa fa-check')
                                $(node).addClass('fa fa-pencil')
                                $(node).css('background','');
                                
                                inc=0
                                for ( i=0;i<data.length;i++) {
                                    valinput=$('.customedit:eq('+inc+')').find('input').val();
                                    arr.push({'id':data[i].id,'number_group':valinput});
                                    inc+=1;
                                }
                                data = JSON.stringify(arr);
                                table.ajaxEdit(table.viewsName[2],data)
                            }else{
                                $(node).removeClass('fa fa-pencil')
                                $(node).addClass('fa fa-check')
                                $(node).css('background','lightgreen');
                                
                                td=$('.customedit');
                                alert(td.length)
                                inc=0;
                                for ( i=0;i<data.length;i++) {
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+data[i].number_group.toString()+'" />');
                                    inc+=1;
                                }
                            }
                        }else{
                            if ($(node).hasClass('fa fa-check')){
                                $(node).removeClass('fa fa-check')
                                $(node).addClass('fa fa-pencil')
                                $(node).css('background','');
                                inc=0;
                                for ( i=0;i<table.arrayForChild.length;i++) {
                                    inc+=1;
                                    table.arrayForChild[i].secondname=$('.customedit:eq('+inc+')').find('input').val();
                                    inc+=1;
                                    table.arrayForChild[i].name=$('.customedit:eq('+inc+')').find('input').val();
                                    inc+=1;
                                    table.arrayForChild[i].thirdname=$('.customedit:eq('+inc+')').find('input').val();  
                                    inc+=1;                              
                                    table.arrayForChild[i].activate=$('.customedit:eq('+inc+')').find('select').val();  
                                    inc+=1;
                                    table.arrayForChild[i].number_group=$('.customedit:eq('+inc+')').find('select').val();  
                                    inc+=1;
                                }
                                data = JSON.stringify(table.arrayForChild);
                                //console.log(data)
                                table.ajaxEditChild(table.viewsName[2],data)
                            }else{
                                $(node).removeClass('fa fa-pencil')
                                $(node).addClass('fa fa-check')
                                $(node).css('background','lightgreen');
                                row=$('.childtr.select');
                                td=$('.customedit');
                                inc=0
                                table.arrayForChild=[];

                                for ( i=0;i<row.length;i++) {
                                    id = $('.table-cell-edit:eq('+inc+')').text();

                                    inc+=1;
                                    secondname = $('.customedit:eq('+inc+')').text();
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+secondname+'" />');
                                    
                                    inc+=1;
                                    name = $('.customedit:eq('+inc+')').text();
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+name+'" />');
                                    
                                    inc+=1;
                                    thirdname = $('.customedit:eq('+inc+')').text();
                                    $('.customedit:eq('+inc+')').html('<input class="form-control form-control mb-2 mr-sm-2 mb-sm-0" type="text"   value="'+thirdname+'" />');
                                    
                                    inc+=1;
                                    activate = $('.customedit:eq('+inc+')').text();      
                                    $('.customedit:eq('+inc+')').html('<select class="form-control" id="activate"></select>');
                                    if (activate=='Активирован'){
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Активирован</option>');
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Не активирован</option>');
                                    }else{
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Не активирован</option>');
                                        $('.customedit:eq('+inc+')').find('select').append('<option>Активирован</option>');
                                    }
                                    
                                    inc+=1;
                                    grouparr=[];
                                    group = $('.customedit:eq('+inc+')').text();
                                    $('.customedit:eq('+inc+')').html('<select class="form-control" class="group"></select>');
                                    for (y=0;y<table.group.length;y++){
                                        if (table.group[y]==group){
                                            $('.customedit:eq('+inc+')').find('select').append('<option>'+group+'</option>');
                                        }else{
                                            grouparr.push(table.group[y]);
                                        }
                                    }
                                    for (y=0;y<grouparr.length;y++){
                                        $('.customedit:eq('+inc+')').find('select').append('<option>'+grouparr[y]+'</option>');
                                    }
                                    
                                    inc+=1;
                                    table.arrayForChild.push({id:id,secondname:secondname,name:name,thirdname:thirdname,activate:activate,number_group:group})
                                    //console.log(table.arrayForChild)
                                }                               
                            }
                        }
                    },
                    className: 'fa fa-pencil '
                },
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        if (!$('.childtr').closest('tr').hasClass("select")){
                            dt = $('#example').DataTable();
                            var data = dt.rows('.select' ).data();
                            console.log(data)
                            var arr=[];
                            data=table.cloneObject(data);  
                            console.log(data)                     
                            for ( i=0;i<data.length;i++) {
                                arr.push(data[i]);
                            }
                            data = JSON.stringify(arr);
                            table.ajaxDelete(table.viewsName[2],data);
                        }else{
                            row=$('.childtr.select');
                            inc=0;
                            table.arrayForChild=[];
                            for ( i=0;i<row.length;i++) {
                                id = $('.table-cell-edit:eq('+inc+')').text();
                                inc+=1;
                                secondname = $('.customedit:eq('+inc+')').text();
                                inc+=1;
                                name = $('.customedit:eq('+inc+')').text();
                                inc+=1;
                                thirdname = $('.customedit:eq('+inc+')').text();
                                inc+=1;
                                activate = $('.customedit:eq('+inc+')').text();      
                                inc+=1;
                                group = $('.customedit:eq('+inc+')').text();
                                inc+=1;
                                table.arrayForChild.push({id:id,secondname:secondname,name:name,thirdname:thirdname,activate:activate,number_group:group})
                                
                            }
                            console.log(table.arrayForChild)
                            data = JSON.stringify(table.arrayForChild);
                            table.ajaxDeleteChild(table.viewsName[2],data);
                        }
                    },
                    className: 'fa fa-times '
                }
            ],
        },
        settingAdminForAdmin:{
            title:[
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                { title: "Фамилия" },
                { title: "Имя" },
                { title: "Отчество" },
                { title: "Роль" },
                { title: "Статус" }       
            ],
            buttons:[
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        alert( 'Button activated' );
                    },
                    className: 'fa fa-pencil '
                },
                {
                    text: '',
                    action: function ( e, dt, node, config ) {
                        alert( 'Button activated' );
                    },
                    className: 'fa fa-times '
                }
            ],
        },
        splitUrl:function(){
            var lastUrl =window.location.href.split('/');
            var count = lastUrl.length;  
            return lastUrl[count-1];
        },
        init:function(){         
            if (table.splitUrl()==table.viewsName[0]){
                table.ajaxDefault(table.splitUrl(),table.settingTeacherForAdmin.buttons,table.settingTeacherForAdmin.title);
            }
            if (table.splitUrl()==table.viewsName[1]) {
                table.createTable(table.settingAdminForAdmin.buttons,table.settingAdminForAdmin.title);
            }
            if (table.splitUrl()==table.viewsName[2]) {
                $('.add').on( 'click', function () {
                    var value = $('#group').val();
                    value=JSON.stringify([{ name: value }]);                     
                    table.ajaxAdd(table.splitUrl(),value);
                } );
                table.ajaxDefault(table.splitUrl(),table.settingGroupForAdmin.buttons,table.settingGroupForAdmin.title);                
            }
            
            
        },
        createTable:function(data,buttons,title){
             var dt = $('#example').DataTable( {
                data:data,
                dom: 'Blfrtip',
                buttons: buttons,
                "ordering": false,
                "info":     false,
                "order": false,
                'search': false,
                'bFilter' :false,
                'bLengthChange':false,
                "columns": title,
                
             } 
            );
            table.check();
            // $('#example tbody').on('click', 'tr td.click', function () {
            //     var data = dt.row( this ).css('background-color', 'Orange');
            //     alert( 'You clicked on '+data[0]+'\'s row' );
            // } );
            table.display(dt);
        },
        check:function(){
            $('#example tbody').on( 'click', '.click',function () {
                if (!$(".dt-button").hasClass("fa-check")){
                    if ($('.childtr').closest('tr').hasClass("select")){
                        $('.childtr').removeClass( 'select' );
                        $('.childtr>td').removeClass( 'table-cell-edit' );
                        $('.childtr>td').removeClass( 'customedit' );
                    }
                    var tr = $(this).closest('tr');
                    tr.toggleClass( 'select' );
                    var td = $(this).parent().find( "td" );
                    td.toggleClass( 'table-cell-edit' );
                    var td = $(this).parent().find( "td.click" );
                    td.toggleClass( 'customedit' );
                    
                }
            } );
            $('#example tbody').on( 'click', '.click1',function () {
                if (!$(".dt-button").hasClass("fa-check")){
                    if ($('.odd').closest('tr').hasClass("select")){
                        $('.odd').removeClass( 'select' );
                        $('.odd>td').removeClass( 'table-cell-edit' );
                        $('.odd>td').removeClass( 'customedit' );
                    }
                    if ($('.even').closest('tr').hasClass("select")){
                        $('.even').removeClass( 'select' );
                        $('.even>td').removeClass( 'table-cell-edit' );
                        $('.even>td').removeClass( 'customedit' );
                    }
                    var tr = $(this).closest('tr');
                    tr.toggleClass( 'select' );
                    var td = $(this).parent().find( "td" );
                    td.toggleClass( 'table-cell-edit' );
                    var td = $(this).parent().find( "td.click1" );
                    td.toggleClass( 'customedit' );
                    
                }
            } );
        },
        display:function(dt){
            $('#example tbody').on( 'click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');               
                var row = dt.row( tr );
                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();
                }
                else {
                    var tr1 = $('tr.details');               
                    var row1 = dt.row( tr1 );
                    $("tr").removeClass( 'details' );
                    row1.child.hide();
                    value=JSON.stringify(row.data());   
                    tr.addClass( 'details' );
                    table.ajaxViewChild(table.splitUrl(),row,value);
                }
            } );
        },
        format:function(d){
            text='';
            text+='<table >'+'<tbody>';
            $.each(d, function(index, value){
                text+='<tr class="childtr" >';
                flag=0;
                text+='<td hidden="false" class="click1">'+value['id']+'</td>';
                 $.each(value, function(key,data){
                    if(flag==1){                                             
                        text+='<td class="click1">'+data+'</td>';
                     }
                    flag=1;
                 });
                 text+='</tr>';
            });
            text+='</tbody>'+'</table>';
            return text;
        },
        ajaxViewChild:function(path,row,data){           
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/selectChild',
                success: function(result){
                    data = JSON.parse(result);
                    //console.log(data)
                    row.child( table.format( data ),'child' ).show();
                }
            });
        },
        ajaxEditChild:function(path,data){       
            console.log(path)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/editChild',
                success: function(result){
                    data = JSON.parse(data);
                    
                    console.log(result);
                    if (table.splitUrl()==table.viewsName[2]) {
                        result = JSON.parse(result);
                        inc=0;
                        for ( i=0;i<data.length;i++) {
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].secondname);
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].name);
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].thirdname);  
                            inc+=1;                              
                            $('.customedit:eq('+inc+')').html(data[i].activate);  
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].number_group); 
                            if (result.length>0) {
                                if (result[i].number_group!=data[i].number_group){
                                    $('.customedit:eq('+inc+')').parent().remove();
                                }
                            }
                            inc+=1;

                        }
                        
                    }
                    if (table.splitUrl()==table.viewsName[0]) {
                        //result = JSON.parse(result);
                        inc=0;
                        for ( i=0;i<data.length;i++) {
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].discipline);
                            inc+=1;

                        }
                    }
                    $('.childtr').removeClass( 'select' );
                        $('.childtr>td').removeClass( 'table-cell-edit' );
                        $('.childtr>td').removeClass( 'customedit' );
                }
            });
        },
        ajaxDeleteChild:function(path,data){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/deleteChild',//'/'+$path+'/select', data[0].id,data[0].number_group
                success: function(data){
                    console.log(data)
                    $('.selected').parent().remove();
                    //dt.rows('.select').remove().draw(false);
                }
            });
        },
        ajaxDefault:function(path,buttons,titles){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: path+'/select',
                success: function(result){
                    data = JSON.parse(result);
                    console.log(result);
                    if (table.splitUrl()==table.viewsName[2]) {
                        for ( i=0;i<data.length;i++) {
                            table.group.push(data[i].number_group);
                        }
                    }
                    table.createTable(data,buttons,titles);
                }
            });
        },
        ajaxAdd:function(path,data){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/add',
                success: function(result){
                    if (table.splitUrl()==table.viewsName[2]) {
                        dt = $('#example').DataTable();
                        //console.log(result);
                        arr=[];
                        arr.push(JSON.parse(result))
                        //console.log(arr);
                        dt.rows.add(arr).draw(false);
                    }
                }
            });
        },
        ajaxEdit:function(path,data){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/edit',
                success: function(result){
                    data = JSON.parse(data);
                    if (table.splitUrl()==table.viewsName[2]) {
                        inc=0;
                        for ( i=0;i<data.length;i++) {
                            $('.customedit:eq('+inc+')').html(data[i].number_group.toString());
                            inc+=1;
                        }
                    }
                    if (table.splitUrl()==table.viewsName[0]) {
                        //result = JSON.parse(result);
                        inc=0;
                        for ( i=0;i<data.length;i++) {
                            $('.customedit:eq('+inc+')').html(data[i].secondname);
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].name);
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].thirdname);  
                            inc+=1;                              
                            $('.customedit:eq('+inc+')').html(data[i].activate);  
                            inc+=1;
                            $('.customedit:eq('+inc+')').html(data[i].role); 
                            if (result.length>0) {
                                if (result[i].role!=data[i].role){
                                    $('.customedit:eq('+inc+')').parent().remove();
                                }
                            }
                            inc+=1;

                        }
                    }
                    $('.odd').removeClass( 'select' );
                    $('.odd>td').removeClass( 'table-cell-edit' );
                    $('.odd>td').removeClass( 'customedit' );
                    $('.even').removeClass( 'select' );
                    $('.even>td').removeClass( 'table-cell-edit' );
                    $('.even>td').removeClass( 'customedit' );
                }
            });
        },
        ajaxDelete:function(path,data){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                url: path+'/delete',//'/'+$path+'/select', data[0].id,data[0].number_group
                success: function(data){
                    console.log(data)
                    dt = $('#example').DataTable();
                    dt.rows('.select').remove().draw(false);
                }
            });
        },
        cloneObject:function (obj) {
            var key, clone = {};
            for(key in obj) if(obj.hasOwnProperty(key)) clone[key] = obj[key];
            return clone;
        }
    }

    table.init();
}(JQuery));