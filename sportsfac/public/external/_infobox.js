function drawInfoboxajax(id,path,sender){
    console.log("entro draw infobox "+path);
    var ibContent = "";
    $.ajax({
        type: "POST",
        url: path + "infobox",
        data: {
            id:id
        },
        cache: false,
        success: function(data){
            console.log(sender);
            console.log(data);
            sender._contentNode.innerHTML = data;
        }
    });
    return ibContent;
}

function drawInfobox(category, infoboxContent, json, i){

    if(json.data[i].color)          { var color = json.data[i].color }
        else                        { color = '' }
    if( json.data[i].price_range )        { var price = '<div class="price">' + json.data[i].price +  '</div>' }
        else                        { price = '' }
    if(json.data[i].id)             { var id = json.data[i].id }
        else                        { id = '' }
    if(json.data[i].website)            { var url = json.data[i].website }
        else                        { url = '' }
    if(json.data[i].type)           { var type = json.data[i].type }
        else                        { type = '' }
    if(json.data[i].title)          { var title = json.data[i].title }
        else                        { title = '' }
    if(json.data[i].address)       { var location = json.data[i].address }
        else                        { location = '' }
    //if(json.data[i].gallery[0])     { var gallery = json.data[i].gallery[0] }
    //    else                        { gallery[0] = '../img/default-item.jpg' }

    var ibContent = '';
    ibContent =
    '<div class="infobox ' + 'green' + '">' +
        '<div class="inner">' +
            '<div class="image">' +
                '<div class="item-specific">' + drawItemSpecific(category, json, i) + '</div>' +
                '<div class="overlay">' +
                    '<div class="wrapper">' +
                        '<a href="#" class="quick-view" data-toggle="modal" data-target="#modal" id="' + id + '">Quick View</a>' +
                        '<hr>' +
                        '<a href="' + url +  '" class="detail">Go to Detail</a>' +
                    '</div>' +
                '</div>' +
                '<a href="' + url +  '" class="description">' +
                    '<div class="meta">' +
                        price +
                        '<h2>' + title +  '</h2>' +
                        '<figure>' + location +  '</figure>' +
                        '<i class="fa fa-angle-right"></i>' +
                    '</div>' +
                '</a>' +
                //'<img src="icons/sports/relaxing-sports/weights.png' +  '">' +
            '</div>' +
        '</div>' +
    '</div>';

    return ibContent;
}