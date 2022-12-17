import axios from 'axios';

const { access_token: token } = window.authUser;
const baseURL = process.env.API_URL.replace(new RegExp('[/]+$'), '');
const http = axios.create({
  baseURL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Access-Control-Allow-Origin': '*',
    Authorization: token ? `Bearer ${token}` : '',
    'Accept-locale': 'en',
  },
});

export default http;
