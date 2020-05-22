function drawDollarSign() {
    canvasId = "dollarSignCanvas"
    console.log("drawing on " + canvasId)

    let canvas  = document.getElementById(canvasId)
    let context = canvas.getContext("2d")

    let dollarSignColor = "green"

    // background
    let backgroundColor = "lightgrey"
    context.fillStyle = backgroundColor
    context.fillRect(0,0, 300,300)

    // 2 vertical stripes
    drawLine(context, 125, 25, 125, 275, 10, dollarSignColor)
    drawLine(context, 150, 25, 150, 275, 10, dollarSignColor)
    
    // draw s
    drawArc(context, 137, 100, 50, 0.5 * Math.PI, 0, dollarSignColor)
    drawArc(context, 137, 200, 50, -0.5*Math.PI, Math.PI, dollarSignColor)
}

function drawLine(context, startX, startY, endX, endY, width, color) {
    console.log("draw line")
    context.beginPath()
    context.strokeStyle = color
    context.lineWidth = width
    context.moveTo(startX, startY)
    context.lineTo(endX, endY)
    context.stroke()
    context.closePath()
}

function drawArc(context, startX, startY, radius, a, b, color) {
    console.log("draw arc")
    context.beginPath()
    context.strokeStyle = color
    context.arc(startX, startY, radius, a, b, false)
    context.stroke()
    context.closePath()
}