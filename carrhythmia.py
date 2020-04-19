
from flask import Flask, render_template, request, jsonify, Response
import jsonpickle
import numpy as np
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn import preprocessing
from sklearn.preprocessing import MinMaxScaler
from sklearn.feature_selection import RFE
from sklearn.feature_selection import RFECV
from sklearn import preprocessing
from matplotlib import pyplot as plt
import pickle
from sklearn.metrics import r2_score, mean_squared_error, classification_report
import sys
import json

app = Flask(__name__)


@app.route('/')
@app.route('/index/')
def index():
	return render_template('index.html')

@app.route('/login/')
def login():
	return render_template('Login_Doc.html')

@app.route('/signup/')
def signup():
	return render_template('Signup_Doc.html')

@app.route('/wavefeature/')
def wavefeature():
	return render_template('Wave_Feature.html')

@app.route('/wave_upload/')
def wave_upload():
	return render_template('Wave_Upload.html')


@app.route('/feature_upload/')
def feature_upload():
	return render_template('Feature_Upload.html')


@app.route('/uploadcsv', methods = ['GET','POST'])
def uploadcsv():
	if request.method == 'POST':
		datacsv = request.files.get("featurefile")
		data = pd.read_csv(datacsv)
		data['J'] = data['J'].replace('?',np.NaN)
		data['Heart_Rate'] = data['Heart_Rate'].replace('?',np.NaN)
		data['P'] = data['P'].replace('?',np.NaN)
		data['T'] = data['T'].replace('?',np.NaN)
		data['QRST'] = data['QRST'].replace('?',np.NaN)
		Data_Y = data.cardiac_arrhythmia.values.ravel()
		Data_X=data.drop('cardiac_arrhythmia', 1)
		np.unique(Data_Y, return_counts=True)

		# We impute mean in place of missing values
		from sklearn.preprocessing import Imputer
		z=Imputer(missing_values=np.nan, strategy='mean', axis=1).fit_transform(Data_X)
		Data_X = pd.DataFrame(data=z,columns=Data_X.columns.values)
		Data_X.isnull().sum()


		from sklearn.preprocessing import MinMaxScaler


		#MinMax
		MinMax = MinMaxScaler(feature_range= (0,1))
		data_test_x = MinMax.fit_transform(Data_X)
		##data_test_x = MinMax.transform(data_test_x)

		data_test_y = Data_Y 


		selected_features = [0, 1, 3, 4, 5, 6, 7, 8, 10, 12, 13, 14, 15, 16, 17, 20, 22, 25, 26, 27, 28, 29, 30, 32, 34, 36, 38, 39, 41, 44, 49, 51, 52, 53, 56, 62, 63, 64, 65, 68, 70, 72, 75, 76, 77, 80, 82, 87, 88, 89, 90, 92, 93, 94, 95, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 111, 112, 113, 116, 119, 120, 122, 123, 124, 125, 128, 129, 134, 135, 136, 137, 138, 140, 142, 146, 147, 148, 149, 152, 154, 158, 159, 160, 161, 162, 166, 167, 168, 169, 170, 171, 172, 173, 175, 176, 177, 178, 180, 181, 188, 189, 190, 191, 195, 196, 197, 198, 199, 200, 201, 202, 206, 207, 208, 209, 210, 211, 212, 216, 219, 220, 221, 222, 223, 225, 226, 227, 228, 229, 230, 231, 232, 233, 235, 236, 237, 238, 239, 240, 241, 242, 245, 246, 247, 248, 249, 250, 251, 252, 256, 257, 258, 259, 260, 261, 262, 263, 265, 266, 267, 268, 269, 270, 271, 272, 275, 276, 277, 278]

		selected_features.append(279)

		##features = fit.transform(data_test_x)

		data1 = data.iloc[:,selected_features]

		Data1_Y = data1.cardiac_arrhythmia.values.ravel()
		Data1_X = data1.drop('cardiac_arrhythmia', 1)
		np.unique(Data1_Y, return_counts=True)
		# We impute mean in place of missing values
		from sklearn.preprocessing import Imputer
		z1=Imputer(missing_values=np.nan, strategy='mean', axis=1).fit_transform(Data1_X)
		Data1_X = pd.DataFrame(data=z1,columns=Data1_X.columns.values)
		Data1_X.isnull().sum()

		#MinMax
		MinMax = MinMaxScaler(feature_range= (0,1))
		data1_test_x = MinMax.fit_transform(Data1_X)
		##data1_test_x = MinMax.transform(data1_test_x)

		data1_test_y = Data1_Y


		filename = 'final_model_KSVM.sav'
		loaded_model = pickle.load(open(filename, 'rb'))


		pred = loaded_model.predict(data1_test_x)
		predicted_class = str(pred)
		predicted_class = predicted_class.replace('[','')
		predicted_class = predicted_class.replace(']','')

		actual_class = str(data1_test_y)
		actual_class = actual_class.replace('[','')
		actual_class = actual_class.replace(']','')
		print("Predicted Class is: "+ predicted_class)
		print("Actual Class is: "+ actual_class)
		# output = (predicted,actual)
		output = []
		output = [int(predicted_class),int(actual_class)]
		
		
		# build a response dict to send back to client
		response = {'Predicted Class - ':int(predicted_class), 'Actual Class - ': int(actual_class)}
		
		if (predicted_class!=1):
			result = "Arrhythmia Detected!!" 
		else:
			result = "Arrhythmia Not Detected!!" 
		
		type = "Predicted Class: " + predicted_class + "  ,  Actual Class:" + actual_class



		return render_template('feature_result.html', result=result, type=type)

@app.route('/uploadwave', methods = ['POST'])
def uploadwave():
	if request.method == 'POST':
		result = "Wave file uploaded successfully!!"
		return render_template('wave_result.html', result=result)


	#return jsonify(result=str1)

if __name__ == "__main__":
	app.run()