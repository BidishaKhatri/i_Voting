from flask import Flask, request, jsonify
from flask_cors import CORS
from deepface import DeepFace
import base64
import cv2
import numpy as np
import os

app = Flask(__name__)
CORS(app)

DB_PATH = "faces"
os.makedirs(DB_PATH, exist_ok=True)

def base64_to_image(base64_str):
    img_data = base64.b64decode(base64_str.split(',')[1])
    np_arr = np.frombuffer(img_data, np.uint8)
    return cv2.imdecode(np_arr, cv2.IMREAD_COLOR)

@app.route('/verify', methods=['POST'])
def verify():
    print("✅ VERIFY API HIT", flush=True)

    try:
        data = request.json
        voter_id = data.get("voter_id")
        image_data = data.get("image")

        captured_img = base64_to_image(image_data)

        stored_path = os.path.join(DB_PATH, f"{voter_id}.jpg")

        if not os.path.exists(stored_path):
            print("❌ No registered face", flush=True)
            return jsonify({"status": "no_registered_face"})

        temp_path = "temp.jpg"
        cv2.imwrite(temp_path, captured_img)

        print("📸 Reached verification step", flush=True)

        result = DeepFace.verify(
            img1_path=stored_path,
            img2_path=temp_path,
            enforce_detection=False,
            distance_metric="cosine"
        )

        print("🔥 RESULT:", result, flush=True)

        if result["distance"] < 0.7:
            return jsonify({"status": "verified"})
        else:
            return jsonify({"status": "failed"})

    except Exception as e:
        print("❌ ERROR:", str(e), flush=True)
        return jsonify({"status": "error", "message": str(e)})

if __name__ == "__main__":
    app.run(port=5000, debug=True)