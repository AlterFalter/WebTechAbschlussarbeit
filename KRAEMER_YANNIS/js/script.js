window.onload = function() {
    console.log("page loaded")
    drawDollarSign()
}

function frequencyChanged() {
    let frequencyInput = document.getElementById("frequency")
    let frequency = frequencyInput.options[frequencyInput.selectedIndex].value
    //console.log("frequency changed to " + frequency)
    
    let usesDeposits = frequency === "noDeposit"
    document.getElementById("deposit").disabled = usesDeposits
}

function isFullNameCorrect() {
    let fullName = document.getElementById('name').value
    let regex = /^([A-Z]{1}[a-z]{1,}\s{1}[A-Z]{1}[a-z]{1,})/
    return fullName.match(regex)
}

function isNumberFormatCorrect(numberToCheck) {
    // only allow 0-9, opt. - in the front, opt. . for float comma
    let regex = /[0-9]{1,10}\.{0,1}[0-9]{0,2}$/
    return numberToCheck.match(regex)
}

function currencyChanged() {
    let startCurrency = document.getElementById("startCurrency")
    let endCurrency = document.getElementById("endCurrency")

    let currenciesAreTheSame = startCurrency.value === endCurrency.value
    document.getElementById("additionalFeatureSubmitButton").disabled = currenciesAreTheSame
    document.getElementById("errorField").hidden = !currenciesAreTheSame
}

function checkValuesBeforeSending() {
    // TODO: show error (label)
    let formHasError = false

    // name
    if (!isFullNameCorrect()) {
        console.log("name is wrong")
        formHasError = true
    }

    // principal
    let principal = document.getElementById('principal').value
    if (!isNumberFormatCorrect(principal)) {
        console.log("principal is wrong")
        formHasError = true
    }

    // interest
    let interest = document.getElementById('interestInPercent').value
    if (!isNumberFormatCorrect(interest)) {
        console.log("interest is wrong")
        formHasError = true
    }

    // deposit
    let deposit = document.getElementById('deposit').value
    if (!isNumberFormatCorrect(deposit)) {
        console.log("deposit is wrong")
        formHasError = true
    }

    // frequency - can't be wrong without modifying code
    frequencyChanged()
    
    // duration
    let duration = document.getElementById('duration').value
    if (!Number.isInteger(parseInt(duration)) || duration < 1) {
        console.log("duration is wrong: " + duration + " | type: " + typeof(duration))
        formHasError = true
    }

    // submit button
    return !formHasError
}