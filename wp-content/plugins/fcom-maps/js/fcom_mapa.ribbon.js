var width = $('#fcom-mapa').width(),
    height = $('#fcom-mapa').height();

var color = d3.scale.category20();

var force = d3.layout.force()
    .charge(-120)
    .linkDistance(30)
    .size([width, height]);

var svg = d3.select("#fcom-mapa").append("svg")
    .attr("width", width)
    .attr("height", height);

d3.json("fcom-maps/json/data", function(error, graph) {
  if (error) throw error;

  force
      .nodes(graph.nodes)
      .links(graph.links)
      .start();

  var link = svg.selectAll(".link")
      .data(graph.links)
    .enter().append("line")
      .attr("class", "link")
      .style("stroke-width", function(d) { return Math.sqrt(d.value); });
  
  var node = svg.selectAll(".node")
      .data(graph.nodes)
    .enter().append("circle")
      .attr("class", "node")
      .attr("r", 5)
      .style("fill", function(d) { return color(d.group); })
      .on("mouseover", function (d) {
        
        // Remove the info text on mouse out.
        d3.select("body").select('div.card').remove();
        
        // The node 
        var g = d3.select(this);
        
        // Html inside        
        html_str = "";
        if(d.img_path != false)
            html_str += "<div class='image'><img src='"+d.img_path[0]+"' height='50px'></div>";
        
        html_str += "<h2>"+d.name+"</h2>";
        html_str += "<small>"+d.fecha.dia+" "+d.fecha.mes+" "+d.fecha.agno+"</small>";
        
        var div = d3.select("body").append("div")
                    .attr('pointer-events', 'none')
                    .attr("class", "tooltip card")
                    .style("opacity", 1)
                    .html(html_str)
                    .style("left", (d.x + 120 + "px"))
                    .style("top", (d.y - 60 + "px"));
      })
      .on("mouseout", function() {
          // Remove the info text on mouse out.
          d3.select("body").select('div.card').remove();
      })
      .on("click", function(d){
         d3.select("body").select('div.story').remove();
		 var g = d3.select(this); // The node
		 var div = d3.select("body").append("div")
		             .attr('pointer-events', 'none')
		             .attr("class", "tooltip story")
		             .style("opacity", 1)
		             .html("<div class='noticias'>Cargando...</div>")
		             .style("right", ("0px"))
                     .style("top", ("50px"));
         $.getJSON("fcom-maps/json/post?id="+d.postId, function( json ) {
            $(".noticias").empty();
            $(".noticias").append('<h2>'+json.titulo+'</h2>');
            $(".noticias").append('<p class="bajada">'+json.bajada+'</p>');
            $(".noticias").append('<div class="meta"><a href="'+json.path+'" class="btn btn-info btn-sm">Ver más</a> Publicado el '+json.fecha.dia+' '+json.fecha.mes+' '+json.fecha.agno+'</div>');
            $(".noticias").append('<hr>');
            $(".noticias").append(json.content);
         });
	  })
      .call(force.drag);

  node.append("title")
      .text(function(d) { return d.name; });
    
  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("cx", function(d) { return d.x; })
        .attr("cy", function(d) { return d.y; });
  });
  
});
