<script>
import axios from "axios";
export default {
    methods: {
        async fetchProduct(data){
            try {
                await axios.post('http://localhost:8000/api/create', data)
                    .then(function (result) {
                        console.log(result);
                    }, function (error) {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
