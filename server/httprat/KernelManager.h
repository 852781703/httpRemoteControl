

#if !defined(AFX_KERNELMANAGER_H__D38BBAEA_31C6_4C8A_8BF7_BF3E80182EAE__INCLUDED_)
#define AFX_KERNELMANAGER_H__D38BBAEA_31C6_4C8A_8BF7_BF3E80182EAE__INCLUDED_

#if _MSC_VER > 1000
#pragma once
#endif // _MSC_VER > 1000

#include "BasicManager.h"

class CKernelManager : public CBasicManager  
{
public:
	BOOL b_signed;//��ʾ�Լ��Ƿ��Ѿ�����

	HANDLE	m_hThread[32]; // 32���߳��㹻����
	UINT	m_nThreadCount;
	char m_servicename[256];
	CKernelManager(CClient *pClient,char* strServicename);
	virtual ~CKernelManager();
	virtual void OnReceive(LPBYTE lpBuff,DWORD dwSize);
	void UnInstallService();
	
};

#endif // !defined(AFX_KERNELMANAGER_H__D38BBAEA_31C6_4C8A_8BF7_BF3E80182EAE__INCLUDED_)
