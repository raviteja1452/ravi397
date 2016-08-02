#include<iostream>
#include<algorithm>
using namespace std;

int main(void){
	int a[4];	
	cin>>a[0]>>a[1]>>a[2]>>a[3];
	sort(a,a+4);
	if((float)a[3]/a[2] == (float)a[1]/a[0]){
		cout<<"Possible";
	}else{
		cout<<"Impossible";
	}
	return 0;
}