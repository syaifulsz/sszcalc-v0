class CalculatorClass
{

    constructor()
    {
        this.isDebug = false;

        this.actionOperations = [ 'plus', 'minus', 'divide', 'times' ];
        this.actionOperationSymbols = {
            plus: '+',
            minus: '-',
            divide: '&div;',
            times: '&times;'
        };
        this.history = [];
        this.computeBucket = [];

        this.buttonSelector = '.js-calculator-button';
        this.screenSelector = '.js-calculator-screen';
        this.formulaSelector = '.js-calculator-formula';
        this.screen = $( '.js-calculator-screen' );
        this.screenValue = '';
        this.isOperation = false;
        this.isEnterNumber = false;

        this.prevOperation = '';
        this.currOperation = '';

        this.init();
    }

    init()
    {
        this.binds();
    }

    binds()
    {
        const self = this;
        const screen = $( self.screenSelector );

        $( this.buttonSelector ).on( 'click', function ( e ) {

            e.preventDefault();

            const btn = $( this );
            const action = btn.data( 'action' );
            const number = btn.data( 'number' );

            self.isOperation = action !== 'enter-number';
            self.isEnterNumber = !self.isOperation;
            self.prevOperation = self.currOperation;
            self.currOperation = action;
            if ( self.isOperation && ( self.prevOperation === self.currOperation ) ) {
                return;
            }

            if ( action === 'equal' ) {
                self.compute();
            } else {
                self.historyAdd( action, number );
            }

            const lastHistory = self.history[ ( self.history.length - 1 ) ];
            const lastHistoryIsOperation = self.actionOperations.includes( lastHistory );
            if ( lastHistoryIsOperation ) {
                self.screenValue = '0';
            }

            if ( self.isEnterNumber ) {
                self.appendNumber( number );
            }

            self.updateScreen();
        } );
    }

    /**
     * @param {String} action
     * @param {String} number
     */
    historyAdd( action, number )
    {
        const isOperation = action !== 'enter-number';
        const isEnterNumber = !isOperation;
        if ( isEnterNumber ) {
            this.history.push( number );
        } else {
            this.history.push( action );
        }
    }

    clear()
    {
    }

    delete()
    {
    }

    appendNumber( number )
    {
        if ( this.screenValue === '0' ) {
            this.screenValue = '';
        }
        this.screenValue = `${this.screenValue}${number}`;
    }

    getComputeFormula()
    {
        const computeBucket = this.getComputeBucket();

        let strArray = [];
        for ( let key in computeBucket ) {
            let item = computeBucket[ key ];
            if ( this.actionOperations.includes( item ) ) {
                strArray.push( this.actionOperationSymbols[ item ] );
            } else {
                strArray.push( item );
            }
        }

        return strArray.join( ' ' );
    }

    getComputeBucket()
    {
        let computeBucket = [];
        let tempNumber = '';
        const historyCount = this.history.length;
        let hIndex = 1;
        for ( let hKey in this.history ) {
            let hItem = this.history[ hKey ];
            if ( this.actionOperations.includes( hItem ) ) {
                computeBucket.push( tempNumber );
                computeBucket.push( hItem );
                tempNumber = '';
            } else {
                tempNumber = `${tempNumber}${hItem}`;
            }
            if ( ( historyCount === hIndex ) && ( tempNumber !== '' ) ) {
                computeBucket.push( tempNumber );
            }
            hIndex++;
        }
        return computeBucket;
    }

    compute()
    {
        const computeBucket = this.getComputeBucket();
        let currValue = 0;
        let prevValue = 0;
        let operation = null;
        let computeValue = 0;

        for ( let key in computeBucket ) {
            let item = computeBucket[ key ];

            if ( this.actionOperations.includes( item ) ) {
                operation = item;
            } else {
                prevValue = currValue;
                currValue = parseFloat( item );

                if ( operation ) {

                    computeValue = 0;
                    if ( operation === 'plus' ) {
                        computeValue = prevValue + currValue;
                    }

                    if ( operation === 'minus' ) {
                        computeValue = prevValue - currValue;
                    }

                    if ( operation === 'divide' ) {
                        computeValue = prevValue / currValue;
                    }

                    if ( operation === 'times' ) {
                        computeValue = prevValue * currValue;
                    }

                    prevValue = 0;
                    currValue = computeValue;
                    operation = null;
                }
            }
        }

        this.screenValue = currValue;
    }

    updateScreen()
    {
        $( this.formulaSelector ).html( this.getComputeFormula() );
        this.screen.html( this.screenValue );
    }
}

window.SSZCalculator = new CalculatorClass();