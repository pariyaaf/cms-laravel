<template>
    <div>
        <canvas style="width:100%" height="400" id="payment"></canvas>

    </div>
</template>

<script>
    import Chart from 'chart.js';

    export default {
    props: ['labels', 'values'],
        mounted() {
            var ctx = this.$refs.payment.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: 'پرداخت های موفق',
                        data: $this.values['success'],
                        backgroundColor: [
                            'rgba(0, 0, 255, 0.5)',
                        borderColor:  'rgba(255,99,132,1)',
                        borderWidth: 1
                    },
                    {
                        label: 'پرداخت های نا موفق',
                        data: $this.values['unsuccess'],
                        backgroundColor: [
                            'rgba(255, 0, 0, 0.2)',
                        borderColor:  'rgba(255,99,132,1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>
