function drawDollarSigns() {
    canvasId = "dollarSignCanvas"
    console.log("drawing on " + canvasId)

    let canvas  = document.getElementById(canvasId)
    let context = canvas.getContext("2d")

    let dollarSignColor = "green"

    // background
    let backgroundColor = "lightgrey"
    context.fillStyle = backgroundColor
    context.fillRect(0,0, 300,300)

    // draw $ with two lines
    drawLine(context, 75, 25, 75, 275, 10, dollarSignColor)
    drawLine(context, 100, 25, 100, 275, 10, dollarSignColor)
    // draw s 
    drawArc(context, 87, 100, 50, 0.5 * Math.PI, 0, dollarSignColor)
    drawArc(context, 87, 200, 50, -0.5*Math.PI, Math.PI, dollarSignColor)

    // draw $ with one line
    drawLine(context, 220, 25, 220, 275, 10, dollarSignColor)
    // draw s 
    drawArc(context, 220, 100, 50, 0.5 * Math.PI, 0, dollarSignColor)
    drawArc(context, 220, 200, 50, -0.5*Math.PI, Math.PI, dollarSignColor)
}

function drawLine(context, startX, startY, endX, endY, width, color) {
    context.beginPath()
    context.strokeStyle = color
    context.lineWidth = width
    context.moveTo(startX, startY)
    context.lineTo(endX, endY)
    context.stroke()
    context.closePath()
}

function drawArc(context, startX, startY, radius, a, b, color) {
    context.beginPath()
    context.strokeStyle = color
    context.arc(startX, startY, radius, a, b, false)
    context.stroke()
    context.closePath()
}
