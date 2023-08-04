<script context="module">
    export { default as layout } from "./layout.svelte";
</script>

<div class="min-h-screen w-full">
    <div id="invoice-POS" class=" mx-auto">
        <center id="top">
            <div class="logo" />
            <div class="info">
                <h2>InovaServices</h2>
            </div>
        </center>

        <div
            id="mid"
            class="flex flex-col mx-auto gap-2 lg:flex-row justify-between"
        >
            <div class="info">
                <h2>Contact Info</h2>
                <p>
                    Address : street city, StaticRange<br />
                    Email : JohnDoe@gmail.com<br />
                    Phone : 555-555-5555<br />
                </p>
            </div>
            <div class="info">
                <h2>Bénéficiare Info</h2>
                <p>
                    Address : street city, StaticRange<br />
                    Email : JohnDoe@gmail.com<br />
                    Phone : 555-555-5555<br />
                </p>
            </div>
        </div>

        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item"><h2>Date</h2></td>
                        <td class="item"><h2>13/01/2024</h2></td>
                    </tr>
                    <tr class="service">
                        <td class="tableitem"
                            ><p class="itemtext">Description</p></td
                        >
                        <td class="tableitem"
                            ><p class="itemtext">
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Ipsam magni minima quidem,
                                voluptatibus tempore officiis ex corrupti.
                                Ducimus sunt, esse, minima nulla odit unde quam,
                                laboriosam neque atque officiis quaerat!
                            </p></td
                        >
                    </tr>
                    <tr class="tabletitle mb-5">
                        <td class="item"><h2>Status</h2></td>
                        <td class="item"><h2>Vérifié</h2></td>
                    </tr>
                    <tr class="tabletitle">
                        <td class="Rate"><h2>Total</h2></td>
                        <td class="payment font-semibold"><h2>$3,644.25</h2></td
                        >
                    </tr>
                </table>
            </div>

            <div id="legalcopy" class="min-h-20 flex justify-end">
                <p class="legal min-h-20 pr-10">Signature:</p>
            </div>
        </div>
    </div>
</div>

<!--End Invoice-->

<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 70%;
        background: #fff;
    }
    #invoice-POS ::selection {
        background: rgb(255, 98, 0);
        color: #fff;
    }
    #invoice-POS ::moz-selection {
        background: rgb(255, 98, 0);
        color: #fff;
    }
    #invoice-POS h1 {
        font-size: 1.5em;
        color: #222;
    }
    #invoice-POS h2 {
        font-size: 0.9em;
    }
    #invoice-POS h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }
    #invoice-POS p {
        font-size: 0.7em;
        color: #666;
        line-height: 1.2em;
    }
    #invoice-POS #top,
    #invoice-POS #mid,
    #invoice-POS #bot {
        border-bottom: 1px solid #eee;
    }
    #invoice-POS #top {
        min-height: 100px;
    }
    #invoice-POS #mid {
        min-height: 80px;
    }
    #invoice-POS #bot {
        min-height: 50px;
    }
    #invoice-POS #top .logo {
        height: 40px;
        width: 40px;
        background: url(data:image/png;base64,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)
            no-repeat;
        background-size: 40px 40px;
    }
    #invoice-POS .clientlogo {
        float: left;
        height: 20px;
        width: 20px;
        background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
        background-size: 20px 60px;
        border-radius: 50px;
    }
    #invoice-POS .info {
        display: block;
        margin-left: 0;
    }
    #invoice-POS .title {
        float: right;
    }
    #invoice-POS .title p {
        text-align: right;
    }
    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }
    #invoice-POS .tabletitle {
        font-size: 0.8em;
        background: #eee;
    }
    #invoice-POS .service {
        border-bottom: 1px solid #eee;
    }
    #invoice-POS .item {
        width: 24mm;
    }
    #invoice-POS .itemtext {
        font-size: 0.8em;
        right: 20mm;
    }
    #invoice-POS #legalcopy {
        margin-top: 5mm;
        margin-bottom: 5mm;
    }
</style>
