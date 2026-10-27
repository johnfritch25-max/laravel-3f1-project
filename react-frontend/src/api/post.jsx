const API_BASE = 'http://localhost:8000/api';

/**
 * Fetch all posts from the API
 */
export async function getPost() {
    const response = await fetch(`${API_BASE}/posts`);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    return response.json();
}

/**
 * Store a new post via the API
 * @param {{ title: string, body: string }} data
 */
export async function storePost(data) {
    const response = await fetch(`${API_BASE}/posts`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data),
    });

    if (!response.ok) {
        const err = await response.json();
        throw new Error(err.message || `HTTP error! status: ${response.status}`);
    }

    return response.json();
}
